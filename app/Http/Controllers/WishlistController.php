<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
   public function add(Request $request)
{
    $productId = $request->input('product_id');

    // Get existing wishlist from session
    $wishlist = session()->get('wishlist', []);

    // Avoid duplicates
    if (!in_array($productId, $wishlist)) {
        $wishlist[] = $productId;
        session()->put('wishlist', $wishlist);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to wishlist!',
            'count' => count($wishlist) // ✅ Send updated count
        ]);
    }

    return response()->json([
        'status' => 'info',
        'message' => 'Product already in wishlist.',
        'count' => count($wishlist) // ✅ Still return count
    ]);
}

}
