<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
public function index()
{
    $faqs = Faq::where('is_active', true)
        ->orderBy('category')
        ->orderBy('topic')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('frontend.help-center', compact('faqs'));
}

public function search(Request $request)
{
    $query = $request->input('q');
    $type  = $request->input('type');

    $faqs = Faq::where('is_active', true);

    if ($type === 'id') {
        // Direct search by ID from suggestion click
        $faqs = $faqs->where('id', $query);
    } else {
        // Normal text search
        $faqs = $faqs->where(function ($q) use ($query) {
            $q->where('question', 'LIKE', "%{$query}%")
              ->orWhere('answer', 'LIKE', "%{$query}%")
              ->orWhere('topic', 'LIKE', "%{$query}%")
              ->orWhere('category', 'LIKE', "%{$query}%");
        });
    }

    $faqs = $faqs->orderBy('created_at', 'desc')->get();

    return view('partials.faqs-list', compact('faqs'));
}



public function suggest(Request $request)
{
    $term = $request->input('q');

    $results = Faq::where('is_active', true)
        ->where(function ($q) use ($term) {
            $q->where('question', 'LIKE', "%{$term}%")
              ->orWhere('answer', 'LIKE', "%{$term}%")
              ->orWhere('topic', 'LIKE', "%{$term}%")
              ->orWhere('category', 'LIKE', "%{$term}%");
        })
        ->limit(10)
        ->orderBy('category')
        ->orderBy('topic')
        ->orderBy('created_at', 'desc')
        ->get(['id', 'category', 'topic', 'question']); // limit fields for speed

    return response()->json($results);
}


}
