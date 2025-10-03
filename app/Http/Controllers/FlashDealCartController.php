<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\FlashDeal;
use Illuminate\Http\Request;

class FlashDealCartController extends Controller
{

public function index()
{
    // Fetch active deals
    $flashDeals = FlashDeal::with('product')
        ->where('end_time', '>', now())
        ->get();

    // Stats
    $totalDeals   = $flashDeals->count();

    $totalSavings = $flashDeals->sum(function ($deal) {
        return max(0, ($deal->product->price - $deal->flash_price));
    });

    $avgDiscount  = $flashDeals->avg(function ($deal) {
        return round(100 - ($deal->flash_price / $deal->product->price * 100));
    });

    $nearestEnd = $flashDeals->min('end_time');
$timeLeft   = $nearestEnd ? now()->diff($nearestEnd)->format('%ad %hh %im') : '—';
    return view('frontend.deals.flash_deals_showcase', compact(
        'totalDeals',
        'totalSavings',
        'avgDiscount',
        'nearestEnd',
        'timeLeft', 'flashDeals'
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
