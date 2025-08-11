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
  public function addAllToCart()
{
    try {
        $userId = auth()->id();
        $wishlistItems = Wishlist::where('user_id', $userId)->get();

        if ($wishlistItems->isEmpty()) {
            return response()->json([
                'status' => 'warning',
                'message' => 'No items to add. Your wishlist is empty.'
            ], 200);
        }

        foreach ($wishlistItems as $item) {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $item->product_id,
                'price' => $item->price,
                'quantity' => 1
            ]);
        }

        Wishlist::where('user_id', $userId)->delete();

        return response()->json([
            'status' => 'success',
            'message' => count($wishlistItems) . ' items successfully added to your cart.'
        ], 200);

    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->errorInfo[1] == 1062) { // MySQL Duplicate Entry
            return response()->json([
                'status' => 'error',
                'message' => 'One or more items are already in your cart.'
            ], 409);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong. Please try again.'
        ], 500);
    }
}

}
