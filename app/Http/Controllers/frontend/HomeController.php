<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FlashDeal;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereHas('products', function($query) {
            $query->where('status', 'active');
        })
        ->withCount(['products' => function($query) {
            $query->where('status', 'active');
        }])
        ->with(['products' => function($query) {
            $query->select('id','category_id','views_count','sales_count');
        }])
        ->where('is_active', 1)
        ->get();

        // Add calculated growth percentage
        $categories->map(function ($category) {
            $totalViews = $category->products->sum('views_count');
            $totalSales = $category->products->sum('sales_count');

            $base = $totalSales + $totalViews;
            // dd($base);
            $category->growth = $base > 0
    ? round((($totalSales * 2) + $totalViews) / ($base * 2) * 100)
    : 0;

            return $category;
        });


         $now = Carbon::now();
         $flashDeals = FlashDeal::with('product')
        ->where('is_active', 1)
        // ->where('end_time', '>=', $now)
        ->limit(4)
        ->get();

        // split active vs upcoming
    $active    = $flashDeals->filter(fn($d) => $d->start_time <= $now && $d->end_time >= $now);
    $upcoming  = $flashDeals->filter(fn($d) => $d->start_time > $now);

    if ($active->isNotEmpty()) {
        $countdownMode = 'ending'; // show "Flash Sale Ending Soon!"
        $target = $active->min('end_time'); // nearest end among active deals
    } elseif ($upcoming->isNotEmpty()) {
        $countdownMode = 'starting'; // show "Flash Sale Starting In"
        $target = $upcoming->min('start_time'); // nearest start among upcoming deals
    } else {
        $countdownMode = 'none';
        $target = null;
    }

    // nice stat: max discount across current deals (percent)
    $maxDiscount = $flashDeals->map(function ($d) {
        if (!empty($d->discount_percent)) return (int)$d->discount_percent;
        if ($d->product && $d->product->price > 0) {
            return (int) round(100 - ($d->flash_price / $d->product->price * 100));
        }
        return 0;
    })->max() ?? 0;

    // pass milliseconds (JS-friendly) to avoid timezone weirdness
    $targetMs = $target ? ($target->getTimestamp() * 1000) : null;
    $successStories = SuccessStory::where('is_active', true)->latest()->take(6)->get();

     // load initial trending products (top 5 by views)
        $topProducts = Product::where('status', 'active')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        // compute percent change compared to ~24h earlier snapshot if available
        $trending = $topProducts->map(function ($p) {
            $nowViews = (int) $p->views_count;

            // find the most recent snapshot at least 24 hours ago
            $old = ProductViewSnapshot::where('product_id', $p->id)
                    ->where('recorded_at', '<=', Carbon::now()->subDay())
                    ->orderBy('recorded_at', 'desc')
                    ->first();

            if ($old) {
                $oldViews = max(1, (int)$old->views_count); // avoid division by zero
                $percent = round((($nowViews - $oldViews) / $oldViews) * 100, 1);
                $trend = $percent > 0 ? 'up' : ($percent < 0 ? 'down' : 'flat');
            } else {
                $percent = null;
                $trend = 'flat';
            }

            return [
                'id' => $p->id,
                'name' => $p->name,
                'slug' => $p->slug,
                'main_image' => $p->main_image,
                'views' => $nowViews,
                'percent_change' => $percent,
                'trend' => $trend,
            ];
        });

        // For Trading activity stats - attempt to collect real values if models exist, otherwise fallback
        $ordersToday = 0;
        $newSuppliers = 0;
        $activeNegotiations = 0;
        $countriesActive = 0;
        try {
            if (class_exists(\App\Models\Order::class)) {
                $ordersToday = \App\Models\Order::whereDate('created_at', now())->count();
            }
            // if (class_exists(\App\Models\Supplier::class)) {
            //     $newSuppliers = \App\Models\Supplier::whereDate('created_at', '>=', now()->subDays(7))->count();
            // }
            // // If you have negotiations table replace below
            // if (class_exists(\App\Models\Negotiation::class)) {
            //     $activeNegotiations = \App\Models\Negotiation::where('status', 'open')->count();
            // }
            // countries active: count distinct countries in users/sellers (fallback to products)
            if (class_exists(\App\Models\User::class)) {
                $countriesActive = \App\Models\User::distinct('country')->count('country');
            }
        } catch (\Throwable $e) {
            // gracefully ignore missing models / columns on dev
        }

        return view('frontend.home',
 [
        'categories'=>$categories,
        'flashDeals' => $flashDeals,
        'countdownMode' => $countdownMode,
        'countdownTargetMs' => $targetMs,
        'maxDiscount' => $maxDiscount,
        'successStories' => $successStories,
         'trending'=>$trending, 
         'ordersToday'=>$ordersToday, 
         'countriesActive'=>$countriesActive
        
        ]);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->where('status', 'active')->paginate(12);

        return view('frontend.categories.show', compact('category', 'products'));
    }
}
