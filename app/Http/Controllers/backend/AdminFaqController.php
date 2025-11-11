<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('admin.support.faqs', compact('faqs'));
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'topic' => 'required|string',
            'question' => 'required|string',
            'answer' => 'required|string',
            'is_active' => 'boolean',
        ]);

        Faq::create($validated);
        return back()->with('success', 'FAQ added successfully.');
    }

public function update(Request $request, Faq $faq)
{
    // Validate incoming request data
    $validated = $request->validate([
        'category' => 'required|string|max:255',
        'topic' => 'required|string|max:255',
        'question' => 'required|string|max:255',
        'answer' => 'required|string',
        'is_active' => 'boolean',  // Validate 'is_active' as boolean
    ]);

    // Update the FAQ with the validated data
    $faq->update($validated);

    // Return with a success message
    return back()->with('success', 'FAQ updated successfully.');
}


    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ deleted successfully.');
    }
}
