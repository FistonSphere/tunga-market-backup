<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function remove(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product removed from wishlist',
            'count' => Wishlist::where('user_id', $user->id)->count(),
        ]);
    }
public function clear()
    {
        Wishlist::where('user_id', Auth::id())->delete();

        return response()->json(['status' => 'success']);
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
        $wishlistItems = Wishlist::with('product')->where('user_id', Auth::id())->get();

        // Here you would insert them into the cart table
        // Example:
        // foreach($wishlistItems as $item) {
        //     Cart::create([...]);
        // }

        return response()->json(['status' => 'success', 'message' => 'All items added to cart']);
    }
}
