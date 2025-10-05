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
        return view('frontend.home',
 [
        'categories'=>$categories,
        'flashDeals' => $flashDeals,
        'countdownMode' => $countdownMode,
        'countdownTargetMs' => $targetMs,
        'maxDiscount' => $maxDiscount,
        'successStories' => $successStories,
        ]);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->where('status', 'active')->paginate(12);

        return view('frontend.categories.show', compact('category', 'products'));
    }
}
