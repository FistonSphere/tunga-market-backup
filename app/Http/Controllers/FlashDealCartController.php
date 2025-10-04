<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        ->where('is_active', 1)
        ->where('start_time', '<=', $now)
        ->where('end_time', '>', $now)
        ->orderByDesc('discount_percent') // top discounts first
        ->take(6) // limit for carousel
        ->get();
    return view('frontend.deals.flash_deals_showcase', compact(
        'flashDeals',
        'totalDeals',
        'totalSavings',
        'avgDiscount',
        'nearestEndMs',
        'timeLeft',
        'activities',
        'featuredDeals',
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
    $query = Product::query()
        ->whereHas('flashDeals', function($q) {
            $q->active(); // scopeActive for active flash deals
        });

    // Category filter
    if ($request->category) {
        $query->where('category', $request->category);
    }

    // Discount filter
    if ($request->discount) {
        $query->whereHas('flashDeals', function($q) use ($request) {
            $q->where('discount_percent', '>=', $request->discount);
        });
    }

    // Price filter
    if ($request->price) {
        if ($request->price === '100+') {
            $query->where('flash_price', '>=', 100);
        } else {
            [$min, $max] = explode('-', $request->price);
            $query->whereBetween('flash_price', [(int)$min, (int)$max]);
        }
    }

    // Time remaining filter
    if ($request->time) {
        $now = now();
        $query->whereHas('flashDeals', function($q) use ($request, $now) {
            if ($request->time === '1h') {
                $q->where('end_date', '<=', $now->copy()->addHour());
            } elseif ($request->time === '6h') {
                $q->where('end_date', '<=', $now->copy()->addHours(6));
            } elseif ($request->time === '1d') {
                $q->where('end_date', '<=', $now->copy()->addDay());
            } elseif ($request->time === '3d') {
                $q->where('end_date', '<=', $now->copy()->addDays(3));
            }
        });
    }

    // Sorting
    switch ($request->sort) {
        case 'ending-soon':
            $query->with(['flashDeals' => fn($q) => $q->orderBy('end_date', 'asc')]);
            break;
        case 'highest-discount':
            $query->with(['flashDeals' => fn($q) => $q->orderBy('discount_percent', 'desc')]);
            break;
        case 'lowest-price':
            $query->orderBy('flash_price', 'asc');
            break;
        case 'highest-rating':
            $query->orderBy('average_rating', 'desc');
            break;
        case 'most-popular':
            $query->orderBy('views', 'desc'); // assuming you track views
            break;
        default:
            $query->latest();
    }

    $products = $query->with('flashDeals')->paginate(12);

    return response()->json($products);
}

}
