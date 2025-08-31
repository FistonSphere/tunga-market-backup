<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
       public function store(Request $request)
    {
        // validate request
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|max:1000',
        ]);

        // save review
        $review = Review::create([
            'product_id' => $validated['product_id'],
            'user_id'    => Auth::id(),
            'rating'     => $validated['rating'],
            'comment'    => $validated['comment'],
        ]);

        // return json for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully!',
            'review'  => [
                'id'      => $review->id,
                'rating'  => $review->rating,
                'comment' => $review->comment,
                'user'    => $review->user->name ?? 'Anonymous',
                'created' => $review->created_at->diffForHumans(),
            ]
        ]);
    }


public function fetchFiltered(Request $request, Product $product)
{
    $filter = $request->input('filter', 'all'); // all, 5,4,3,etc.
    $sort = $request->input('sort', 'recent'); // recent, helpful, high, low

    $reviews = $product->reviews()->where('verified', true);

    // Filter by rating if numeric
    if (is_numeric($filter)) {
        $reviews->where('rating', $filter);
    }

    // Sort
    switch ($sort) {
        case 'recent':
            $reviews->orderBy('created_at', 'desc');
            break;
        case 'helpful':
            $reviews->orderBy('helpful_count', 'desc');
            break;
        case 'high':
            $reviews->orderBy('rating', 'desc');
            break;
        case 'low':
            $reviews->orderBy('rating', 'asc');
            break;
        default:
            $reviews->orderBy('created_at', 'desc');
    }

    $reviews = $reviews->get();

    // Return HTML view fragment for AJAX
    $html = view('partials.product-reviews', compact('reviews'))->render();

    return response()->json([
        'html' => $html,
        'count' => $reviews->count(),
    ]);
}

}
