<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    // $shipping = 12.99;

    // Example: Tax calculation (7.2%)
    $tax = ($subtotal - $bulkDiscount) * 0.072;

    $total = $subtotal - $bulkDiscount + $tax;
    $featureProducts= Product::where('status', 'active')
        ->inRandomOrder()
        ->take(4)
        ->get();
    return view('frontend.cart', compact(
        'cartItems',
        'subtotal',
        'bulkDiscount',
        // 'shipping',
        'tax',
        'total',
        'totalItems',
        'featureProducts'
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
    // $shipping = 15;
    $tax = $subtotal * 0.05;
    $total = $subtotal - $bulkDiscount + $tax;

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
        'status' => '200',
        'message' => 'Item removed from cart.',
        'item' => [
        'id' => $cartItem->id,
        'currency' => $cartItem->product->currency,
        'total_price' => number_format($cartItem->price * $cartItem->quantity, 2)
    ],
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
public function updateItem(Request $request, $id)
{
    $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    // Recalculate totals
    $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

    $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
    $totalItems = $cartItems->sum('quantity');
    $bulkDiscount = ($totalItems > 5) ? $subtotal * 0.1 : 0;
    $shipping = 12.99;
    $tax = ($subtotal - $bulkDiscount + $shipping) * 0.072;
    $total = $subtotal - $bulkDiscount + $shipping + $tax;

    return response()->json([
        'itemTotal' => $cartItem->product->currency . number_format($cartItem->price * $cartItem->quantity, 2),
        'subtotal' => number_format($subtotal, 2),
        'bulkDiscount' => number_format($bulkDiscount, 2),
        'shipping' => number_format($shipping, 2),
        'tax' => number_format($tax, 2),
        'total' => number_format($total, 2),
        'totalItems' => $totalItems
    ]);
}

public function quickAdd(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer|exists:products,id',
        'qty' => 'required|integer|min:1'
    ]);

    $userId = auth()->id();
    $productId = $request->product_id;
    $qty = $request->qty;

    // ✅ Check if already exists
    $existing = Cart::where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

    if ($existing) {
        return response()->json([
            'success' => false,
            'message' => 'This product is already in your cart. You can adjust its quantity from the cart page.'
        ], 409); // 409 Conflict
    }

    // Create new cart item
    $product = Product::findOrFail($productId);
    $cartItem = Cart::create([
        'user_id' => $userId,
        'product_id' => $productId,
        'price' => $product->discount_price ?? $product->price,
        'quantity' => $qty
    ]);

    // Get updated cart summary
    $cartItems = Cart::with('product')->where('user_id', $userId)->get();
    $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
    $totalItems = $cartItems->sum('quantity');
    $bulkDiscount = ($totalItems > 5) ? $subtotal * 0.1 : 0;
    // $shipping = 12.99;
    $tax = ($subtotal - $bulkDiscount) * 0.072;
    $total = $subtotal - $bulkDiscount + $tax;

    return response()->json([
        'success' => true,
        'cartCount' => $cartItems->count(),
        'cart' => [
            'totalItems' => $totalItems,
            'subtotal' => number_format($subtotal, 2),
            'bulkDiscount' => number_format($bulkDiscount, 2),
            'tax' => number_format($tax, 2),
            'total' => number_format($total, 2),
        ]
    ]);
}

}
