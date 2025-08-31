<?php

namespace App\Http\Controllers;

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
}
