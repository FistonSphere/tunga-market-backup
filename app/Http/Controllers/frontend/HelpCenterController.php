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

    $faqs = Faq::where('is_active', true)
        ->where(function ($q) use ($query) {
            $q->where('question', 'LIKE', "%{$query}%")
              ->orWhere('answer', 'LIKE', "%{$query}%")
              ->orWhere('topic', 'LIKE', "%{$query}%")
              ->orWhere('category', 'LIKE', "%{$query}%");
        })
        ->orderBy('category')
        ->orderBy('topic')
        ->get()
        ->groupBy('category')
        ->map(function ($categoryGroup) {
            return $categoryGroup->groupBy('topic');
        });

    return view('frontend.help-center', compact('faqs', 'query'));
}

}
