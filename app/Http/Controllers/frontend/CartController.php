<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
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
    $tax = ($subtotal) * 0.1;

    $total = $subtotal - $bulkDiscount + $tax;
    $featureProducts= Product::where('status', 'active')
        ->inRandomOrder()
        ->take(4)
        ->get();

        $discountPromo = Cart::with('product')
    ->where('user_id', Auth::id())
    ->get()
    ->sum(function ($cart) {
        if ($cart->product && $cart->product->discount_price) {
            return ($cart->product->price - $cart->product->discount_price) * $cart->quantity;
        }
        return 0;
    });

        
        
    return view('frontend.cart', compact(
        'cartItems',
        'subtotal',
        'bulkDiscount',
        'discountPromo',
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
    $tax = $subtotal * 0.1;
    $total = $subtotal - $bulkDiscount + $tax;

    return response()->json([
        'totalItems'    => $totalItems,
        'subtotal'      => number_format($subtotal, 2),
        'bulkDiscount'  => number_format($bulkDiscount, 2),
        // 'shipping'      => number_format($shipping, 2),
        'tax'           => number_format($tax, 2),
        'total'         => number_format($total, 2),
        'itemTotal'     => number_format($cartItem->price * $cartItem->quantity, 2),
    ]);
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
    $tax = ($subtotal - $bulkDiscount + $shipping) * 0.1;
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
    $tax = ($subtotal - $bulkDiscount) * 0.1;
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


public function removeSelected(Request $request)
    {
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'items'   => 'array',
            'items.*' => 'integer',
            'all'     => 'sometimes|boolean',
        ]);

        $removed = 0;

        // Remove ALL items
        if ($request->boolean('all')) {
            $removed = Cart::where('user_id', $userId)->delete();

        // Remove SELECTED items
        } else {
            $ids = $validated['items'] ?? [];
            if (!empty($ids)) {
                $removed = Cart::where('user_id', $userId)
                    ->whereIn('id', $ids)
                    ->delete();
            }
        }

        // Recalculate summary
        $cartItems   = Cart::where('user_id', $userId)->get();
        $subtotal    = $cartItems->sum(fn ($i) => $i->price * $i->quantity);
        $totalItems  = $cartItems->sum('quantity');
        $bulkDiscount = $subtotal > 200 ? $subtotal * 0.10 : 0;
        $shipping    = 0;           // adjust if you have shipping rules
        $tax         = $subtotal * 0.1;
        
        $total       = $subtotal - $bulkDiscount + $shipping + $tax;

        // (Optional) also return a rendered summary partial if you want to replace the HTML
        $summaryHtml = view('partials.order-summary', compact(
            'subtotal', 'totalItems', 'bulkDiscount', 'shipping', 'tax', 'total'
        ))->render();

        return response()->json([
            'status'    => 'success',
            'message'   => $removed > 1 ? 'Selected items removed from your cart.' :
                            ($removed === 1 ? 'Item removed from your cart.' : 'No items removed.'),
            'removed'   => $removed,
            'cartCount' => $totalItems,
            'cart'      => [
                'totalItems'   => $totalItems,
                'subtotal'     => number_format($subtotal, 2),
                'bulkDiscount' => number_format($bulkDiscount, 2),
                'shipping'     => number_format($shipping, 2),
                'tax'          => number_format($tax, 2),
                'total'        => number_format($total, 2),
            ],
            'summaryHtml' => $summaryHtml,
        ]);
    }

 public function storeItem(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
        'variant_id' => 'nullable|integer' // if you support variants
    ]);

    $product = Product::select('id','price','discount_price','currency','stock_quantity','min_order_quantity')
        ->findOrFail($request->product_id);

    // Enforce MOQ and stock (optional but recommended)
    $qty = max($request->quantity, (int)($product->min_order_quantity ?? 1));
    if ($product->stock_quantity !== null && $product->stock_quantity > 0 && $qty > $product->stock_quantity) {
        $qty = $product->stock_quantity;
    }

    // Decide unit price: discount > base
    $unitPrice = $product->discount_price !== null ? $product->discount_price : $product->price;

    // If you have variants and a variant_id is passed, override price if variant has price
    $variantId = $request->variant_id ?? null;
    if ($variantId) {
        $variant = ProductVariant::where('product_id', $product->id)
            ->where('id', $variantId)
            ->first();

        if ($variant && $variant->price_override !== null) {
            $unitPrice = $variant->price_override;
        }
    }

    // Use firstOrNew so we can safely set required fields on create,
    // and increment quantity without DB::raw on insert.
    $cart = Cart::firstOrNew([
        'user_id'    => auth()->id(),
        'product_id' => $product->id,
        // uncomment if your carts table has variant_id
        // 'variant_id' => $variantId,
    ]);

    if (! $cart->exists) {
        $cart->quantity = 0; // initialize for new rows
        $cart->price    = $unitPrice;          // required by DB
        $cart->currency = $product->currency;  // required by DB
        // $cart->selected_specs = $request->input('selected_specs'); // if you store JSON of choices
    }

    // Increment quantity (respecting stock)
    $newQty = $cart->quantity + $qty;
    if ($product->stock_quantity !== null && $product->stock_quantity > 0) {
        $newQty = min($newQty, $product->stock_quantity);
    }
    $cart->quantity = $newQty;

    // If you want to always refresh unit price to current discount/base:
    $cart->price    = $unitPrice;
    $cart->currency = $product->currency;

    $cart->save();

    $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');

    return response()->json([
        'status'    => 'success',
        'message'   => 'Product added to cart successfully!',
        'cartCount' => $cartCount,
    ]);
}

}
