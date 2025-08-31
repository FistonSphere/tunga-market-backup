<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        $review = Review::create([
            'product_id' => $validated['product_id'],
            'user_id'    => Auth::id(),
            'rating'     => $validated['rating'],
            'comment'    => $validated['comment'],
        ]);

        return response()->json([
            'success' => true,
            'review' => [
                'id'       => $review->id,
                'user'     => $review->user->name,
                'initials' => strtoupper(substr($review->user->name, 0, 1)),
                'rating'   => $review->rating,
                'comment'  => $review->comment,
                'created_at' => $review->created_at->diffForHumans(),
            ]
        ]);
    }
}
