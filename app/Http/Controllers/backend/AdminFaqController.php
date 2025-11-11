<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->paginate(10);
        return view('admin.support.faqs', compact('faqs'));
    }



public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'category' => 'required|string',
        'topic' => 'required|string',
        'question' => 'required|string',
        'answer' => 'required|string',
        'is_active' => 'required|boolean'
    ]);

    // Create new FAQ
    $faq = Faq::create([
        'category' => $request->category,
        'topic' => $request->topic,
        'question' => $request->question,
        'answer' => $request->answer,
        'is_active' => $request->is_active,
    ]);

    // Redirect back with success message
    return back()->with('success', 'FAQ created successfully!');
}







    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ deleted successfully.');
    }
}
