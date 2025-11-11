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
    $validated = $request->validate([
        'category' => 'nullable|string|max:255',
        'topic' => 'nullable|string|max:255',
        'question' => 'nullable|string|max:255',
        'answer' => 'nullable|string',
        'is_active' => 'nullable|boolean',
    ]);

    // Update FAQ
    $faq->update($validated);

    return back()->with('success', 'FAQ updated successfully!');
}






    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ deleted successfully.');
    }
}
