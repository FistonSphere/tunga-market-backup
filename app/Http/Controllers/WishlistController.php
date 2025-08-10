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
}
