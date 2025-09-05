<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
     // Add product to wishlist
    public function add(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        // Check if product already in wishlist
        $exists = Wishlist::where('user_id', $user->id)
                          ->where('product_id', $productId)
                          ->exists();

        if ($exists) {
            return response()->json([
                'status' => 'info',
                'message' => 'Product already in wishlist',
                'count' => Wishlist::where('user_id', $user->id)->count(),
            ]);
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to wishlist',
            'count' => Wishlist::where('user_id', $user->id)->count(),
        ]);
    }
   
    // Remove product from wishlist
    public function destroy(Product $product)
{
    Wishlist::where('user_id', auth()->id())
        ->where('product_id', $product->id)
        ->delete();

    return response()->json(['success' => true, 'message' => 'Removed from wishlist']);
}
public function clearAll(Request $request)
{
    $user = $request->user();

    // Delete all wishlist items for the logged-in user
    $deleted = $user->wishlistItems()->delete();

    if ($deleted) {
        return response()->json([
            'status'  => 'success',
            'message' => 'Your wishlist has been cleared.'
        ]);
    }

    return response()->json([
        'status'  => 'error',
        'message' => 'No items found in your wishlist.'
    ], 404);
}


    public function getWishlist()
    {
        $wishlist = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'count' => $wishlist->count(),
            'items' => $wishlist->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product->id,
                    'name' => $item->product->name,
                    'brand' => $item->product->brand ?? '',
                    'price' => $item->product->price,
                    'old_price' => $item->product->old_price,
                    'image' => $item->product->image_url,
                    'discount' => $item->product->old_price
                        ? round((($item->product->old_price - $item->product->price) / $item->product->old_price) * 100)
                        : null,
                    'in_stock' => $item->product->stock > 0,
                    'price_drop' => $item->product->old_price && $item->product->price < $item->product->old_price
                ];
            })
        ]);
    }

    // Get wishlist count (optional, useful for JS refresh)
    public function count()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['count' => 0]);
        }

        $count = Wishlist::where('user_id', $user->id)->count();

        return response()->json(['count' => $count]);
    }
     public function addAllToCart(Request $request)
    {
        $userId = Auth::id();

        // Fetch all wishlist items for the user
        $wishlistItems = Wishlist::where('user_id', $userId)->get();

        if ($wishlistItems->isEmpty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Your wishlist is empty. Nothing to add to cart.',
            ], 200);
        }

        DB::transaction(function () use ($wishlistItems, $userId) {
            foreach ($wishlistItems as $item) {
                // Add to cart
                Cart::create([
                    'user_id'    => $userId,
                    'product_id' => $item->product_id,
                    'price' => $item->product->discount_price ?? $item->product->price,
                    'quantity'   => 1, // You can adjust this based on your logic
                ]);

                // Soft delete wishlist item
                $item->delete();
            }
        });

        return response()->json([
            'status' => 'success',
            'message' => count($wishlistItems) . ' items added to cart successfully.',
        ], 200);
    }

public function addToCart(Product $product)
{
    $userId = Auth::id();

    // Check if the product is already in cart
    $cartItem = Cart::where('user_id', $userId)
        ->where('product_id', $product->id)
        ->first();

    if ($cartItem) {
        // Increase quantity by 1
        $cartItem->quantity += 1;
        $cartItem->save();
    } else {
        // Add new cart item
        Cart::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'price' => $product->price,
            'quantity' => 1
        ]);
    }

    // Optional: remove from wishlist
    Wishlist::where('user_id', $userId)
        ->where('product_id', $product->id)
        ->delete();

    // Return updated cart data for live update
    $cartItems = Cart::with('product')->where('user_id', $userId)->get();
    $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
    $totalItems = $cartItems->sum('quantity');
    $bulkDiscount = ($totalItems > 5) ? $subtotal * 0.1 : 0;
    $shipping = 12.99;
    $tax = $cartItems->sum(fn($item) => $item->price * ($item->product->taxClass->rate ?? 0) / 100);
    $total = $subtotal - $bulkDiscount + $shipping + $tax;

    return response()->json([
        'status' => 'success',
        'message' => "{$product->name} added to cart",
        'cart' => [
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
