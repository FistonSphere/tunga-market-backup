<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
     public function add(Request $request)
    {
        $productId = $request->input('product_id');

        if (!$productId) {
            return response()->json(['success' => false, 'message' => 'Product ID missing']);
        }

        // Get current wishlist from session or empty array
        $wishlist = session()->get('wishlist', []);

        // Avoid duplicates
        if (!in_array($productId, $wishlist)) {
            $wishlist[] = $productId;
            session(['wishlist' => $wishlist]);
        }

        return response()->json(['success' => true, 'wishlist' => $wishlist]);
    }
}
