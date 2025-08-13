<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   public function index()
   {

   $cartItems = Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();

    $subtotal = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // Example: Bulk discount logic (10% discount if more than 5 items)
    $totalItems = $cartItems->sum('quantity');
    $bulkDiscount = ($totalItems > 5) ? $subtotal * 0.1 : 0;

    // Example: Shipping flat rate
    $shipping = 12.99;

    // Example: Tax calculation (7.2%)
    $tax = ($subtotal - $bulkDiscount + $shipping) * 0.072;

    $total = $subtotal - $bulkDiscount + $shipping + $tax;

    return view('frontend.cart', compact(
        'cartItems',
        'subtotal',
        'bulkDiscount',
        'shipping',
        'tax',
        'total',
        'totalItems'
    ));
   }

   public function updateQuantity(Request $request, $id)
{
    $cartItem = Cart::where('user_id', auth()->id())->findOrFail($id);
    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    // Recalculate order summary
    $cartItems = Cart::where('user_id', auth()->id())->get();
    $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
    $totalItems = $cartItems->sum('quantity');
    $bulkDiscount = $subtotal > 200 ? $subtotal * 0.1 : 0;
    $shipping = 15;
    $tax = $subtotal * 0.05;
    $total = $subtotal - $bulkDiscount + $shipping + $tax;

    $summaryHtml = view('partials.order-summary', compact(
        'subtotal', 'totalItems', 'bulkDiscount', 'shipping', 'tax', 'total'
    ))->render();

    return response()->json(['summaryHtml' => $summaryHtml]);
}
public function removeItem($id)
{
    $cartItem = Cart::where('id', $id)
        ->where('user_id', Auth::id())
        ->first();

    if (!$cartItem) {
        return response()->json([
            'status' => 'error',
            'message' => 'Cart item not found.'
        ], 404);
    }

    $cartItem->delete();

    // Get updated cart items
    $cartItems = Cart::with('product.taxClass')
        ->where('user_id', Auth::id())
        ->get();

    $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
    $totalItems = $cartItems->sum('quantity');
    $bulkDiscount = ($totalItems > 5) ? $subtotal * 0.1 : 0;
    $shipping = 12.99;

    // Calculate tax based on each product's tax_class
    $tax = $cartItems->sum(function ($item) use ($bulkDiscount, $shipping, $subtotal) {
        $taxRate = $item->product->taxClass->rate ?? 0;
        return ($item->price * $item->quantity) * ($taxRate / 100);
    });

    $total = $subtotal - $bulkDiscount + $shipping + $tax;

    return response()->json([
        'status' => 'success',
        'message' => 'Item removed from cart.',
        'cart' => [
            'items' => $cartItems,
            'subtotal' => number_format($subtotal, 2),
            'bulkDiscount' => number_format($bulkDiscount, 2),
            'shipping' => number_format($shipping, 2),
            'tax' => number_format($tax, 2),
            'total' => number_format($total, 2),
            'totalItems' => $totalItems
        ]
    ]);
}


}
