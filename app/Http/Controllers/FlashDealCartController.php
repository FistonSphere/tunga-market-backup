<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\FlashDeal;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FlashDealCartController extends Controller
{



public function index()
{
    // Fetch deals that still end in the future
    $flashDeals = FlashDeal::with('product')
        ->where('end_time', '>', now())
        ->paginate(4);

    // Stats
    $totalDeals = $flashDeals->count();

    $totalSavings = $flashDeals->sum(function ($deal) {
        if (!$deal->product || !$deal->product->price) return 0;
        return max(0, ($deal->product->price - $deal->flash_price));
    });

    // Average discount (only consider deals where product price > 0)
    $avgDiscount = $flashDeals
        ->filter(fn($d) => $d->product && $d->product->price > 0)
        ->avg(fn($d) => 100 - ($d->flash_price / $d->product->price * 100));
    $avgDiscount = $avgDiscount ? round($avgDiscount) : 0;

    // Prefer *currently active* deals (start_time <= now < end_time).
    // If none active, fall back to the nearest upcoming end_time.
    $now = Carbon::now();

    $activeDeals = $flashDeals->filter(function ($d) use ($now) {
        // ensure Carbon parsing if attribute is string
        $start = $d->start_time ? Carbon::parse($d->start_time) : null;
        $end = $d->end_time ? Carbon::parse($d->end_time) : null;
        return $start && $end && $start->lte($now) && $end->gt($now);
    });

    if ($activeDeals->isNotEmpty()) {
        $nearestEnd = Carbon::parse($activeDeals->min('end_time'));
    } elseif ($flashDeals->isNotEmpty()) {
        // next upcoming end_time among all future deals
        $nearestEnd = Carbon::parse($flashDeals->min('end_time'));
    } else {
        $nearestEnd = null;
    }

    // convert to epoch milliseconds to avoid any client timezone parsing issues
    $nearestEndMs = $nearestEnd ? ($nearestEnd->getTimestamp() * 1000) : null;
    $timeLeft   = $nearestEnd ? now()->diff($nearestEnd)->format('%ad %hh %im') : '—';

     $discountedProducts = Product::whereNotNull('discount_price')
        ->inRandomOrder()
        ->take(5)
        ->get();

    // 3. Static / predefined daily shopping tips (localized for Rwanda)
    $tips = [
        "Always compare delivery fees between Kigali-based shops.",
        "Check if the seller is registered with RDB before large purchases.",
        "Prefer using Mobile Money (MoMo) for safe transactions.",
        "Look for products with return policies — common in Rwanda’s major shops.",
        "Flash sales usually peak on weekends in Kigali — plan purchases ahead.",
    ];

    // 4. Merge into activity feed
    $activities = collect();

    // Add deals
    foreach ($activeDeals as $deal) {
        $activities->push([
            'type' => 'deal',
            'message' => "{$deal->product->name} now {$deal->discount_percent}% OFF in Flash Sale!",
        ]);
    }

    // Add discounted products
    foreach ($discountedProducts as $product) {
        $activities->push([
            'type' => 'discount',
            'message' => "{$product->name} available at discount price RWF " . number_format($product->discount_price) . " Rwf.",
        ]);
    }

    // Add random tips
    foreach ($tips as $tip) {
        $activities->push([
            'type' => 'tip',
            'message' => "💡 Tip: {$tip}",
        ]);
    }

    // Shuffle so feed feels alive
    $activities = $activities->shuffle()->take(10);

    $featuredDeals = FlashDeal::with('product')
        ->active()
        ->orderBy('start_time', 'desc')
        ->limit(4)
        ->get();


     // Get category IDs from products in flash deals
$categoryIds = Product::whereIn('id', $flashDeals->pluck('product_id'))
    ->pluck('category_id')
    ->unique()
    ->values();

// Fetch actual category names
$categories = Category::whereIn('id', $categoryIds)
    ->pluck('name')
    ->unique()
    ->values();


    // Dynamic price ranges based on existing flash deal prices
    $prices = Product::whereIn('id', $flashDeals->pluck('product_id'))
        ->pluck('price')
        ->toArray();

    $minPrice = !empty($prices) ? floor(min($prices)) : 0;
    $maxPrice = !empty($prices) ? ceil(max($prices)) : 0;


    // Create dynamic price range brackets based on real data
    $priceRanges = [];
    if ($maxPrice > 0) {
        $step = max(25, ceil($maxPrice / 4));
        for ($i = 0; $i < $maxPrice; $i += $step) {
            $start = $i;
            $end = min($i + $step, $maxPrice);
            $priceRanges[] = "{$start}-{$end}";
        }
        $priceRanges[] = "{$maxPrice}+";
    }

    // Dynamic discount percentages from flash deals
    $discounts = FlashDeal::selectRaw('DISTINCT FLOOR(discount_percent/10)*10 as discount_group')
        ->pluck('discount_group')
        ->sortDesc()
        ->values();

    // Dynamic time remaining categories based on deal end times
    $now = now();
    $timeCategories = collect([
        '1h' => FlashDeal::where('end_time', '<=', $now->copy()->addHour())->exists(),
        '6h' => FlashDeal::where('end_time', '<=', $now->copy()->addHours(6))->exists(),
        '1d' => FlashDeal::where('end_time', '<=', $now->copy()->addDay())->exists(),
        '3d' => FlashDeal::where('end_time', '<=', $now->copy()->addDays(3))->exists(),
    ])->filter()->keys(); // Only keep time filters that actually have results

    return view('frontend.deals.flash_deals_showcase', compact(
        'flashDeals',
        'totalDeals',
        'totalSavings',
        'avgDiscount',
        'nearestEndMs',
        'timeLeft',
        'activities',
        'featuredDeals', 
        'categories', 
        'discounts', 
        'priceRanges', 
        'timeCategories'
    ));
}




   public function add(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $deal = FlashDeal::with('product')->findOrFail($request->deal_id);

        // Check if deal is active
        if (!$deal->is_active || now()->lt($deal->start_time) || now()->gt($deal->end_time)) {
            return response()->json(['status' => 'error', 'message' => 'This flash deal is no longer active.']);
        }

        $product = $deal->product;

        // Add to cart (simplified)
        Cart::updateOrCreate(
    [
        'user_id' => auth()->id(),
        'product_id' => $product->id,
        'deal_id' =>  $deal ? $deal->id : null, // track flash deal
    ],
    [
        'quantity' => $request->quantity,
        'price' => $deal ? $deal->flash_price : $product->price,
        'currency' => $product->currency, // use product’s currency
    ]
);


        $cartCount = Cart::where('user_id', auth()->id())->count();

        return response()->json([
            'status' => 'success',
            'message' => 'Flash deal added to cart!',
            'cartCount' => $cartCount,
        ]);
    }


public function loadMore(Request $request) 
{
    $page = (int) $request->get('page', 1);
    $perPage = 4;

    // Corrected skip calculation
    $skip = ($page - 1) * $perPage;

    $flashDeals = FlashDeal::with('product')
        ->orderBy('created_at', 'desc')
        ->skip($skip)
        ->take($perPage)
        ->get();

    $html = '';
    foreach ($flashDeals as $deal) {
        $html .= view('partials.deal-card', compact('deal'))->render();
    }

    return response()->json([
        'html' => $html,
        'hasMore' => $flashDeals->count() === $perPage,
    ]);
}

public function filter(Request $request)
{
    $query = FlashDeal::with('product');

    // CATEGORY FILTER
     // Filter by category name
    if ($request->filled('category')) {
        $category = Category::where('name', $request->category)->first();

        if ($category) {
            $query->whereHas('product', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            });
        } else {
            // No matching category — no deals to return
            return response()->json([
                'html' => '',
                'hasMore' => false,
            ]);
        }
    }

    // DISCOUNT FILTER
    if ($request->filled('discount')) {
        $query->where('discount_percent', '>=', (int) $request->discount);
    }

    // PRICE FILTER
    if ($request->filled('price')) {
        $range = explode('-', $request->price);
        if (count($range) === 2) {
            $query->whereHas('product', function ($q) use ($range) {
                $q->whereBetween('price', [$range[0], $range[1]]);
            });
        } elseif (str_contains($request->price, '+')) {
            $min = (int) rtrim($request->price, '+');
            $query->whereHas('product', function ($q) use ($min) {
                $q->where('price', '>=', $min);
            });
        }
    }

    // TIME FILTER
    if ($request->filled('time')) {
        $now = now();
        switch ($request->time) {
            case '1h': $query->where('end_time', '<=', $now->addHour()); break;
            case '6h': $query->where('end_time', '<=', $now->addHours(6)); break;
            case '1d': $query->where('end_time', '<=', $now->addDay()); break;
            case '3d': $query->where('end_time', '<=', $now->addDays(3)); break;
        }
    }

    // SORTING
    switch ($request->sort) {
        case 'ending-soon':
            $query->orderBy('end_time', 'asc');
            break;
        case 'highest-discount':
            $query->orderBy('discount_percent', 'desc');
            break;
        case 'lowest-price':
            $query->join('products', 'flash_deals.product_id', '=', 'products.id')
                  ->orderBy('products.price', 'asc')
                  ->select('flash_deals.*');
            break;
        case 'highest-rating':
            $query->join('products', 'flash_deals.product_id', '=', 'products.id')
                  ->orderBy('products.rating', 'desc')
                  ->select('flash_deals.*');
            break;
        case 'most-popular':
            $query->orderBy('views', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    // FETCH RESULTS
    $flashDeals = $query->take(12)->get();

    $html = '';
    foreach ($flashDeals as $deal) {
        $html .= view('partials.deal-card', compact('deal'))->render();
    }

    return response()->json([
        'html' => $html
    ]);
}

}
