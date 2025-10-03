<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\FlashDeal;
use Illuminate\Http\Request;

class FlashDealCartController extends Controller
{

use Carbon\Carbon;

public function index()
{
    // Fetch deals that still end in the future
    $flashDeals = FlashDeal::with('product')
        ->where('end_time', '>', now())
        ->get();

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

    return view('frontend.deals.flash_deals_showcase', compact(
        'flashDeals',
        'totalDeals',
        'totalSavings',
        'avgDiscount',
        'nearestEndMs'
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
}
