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
    // Log the incoming request data to debug
    Log::info('Updating FAQ with ID: ' . $faq->id);
    Log::info('Request Data: ', $request->all());

    // Validate incoming request data
    $validated = $request->validate([
        'category' => 'required|string|max:255',
        'topic' => 'required|string|max:255',
        'question' => 'required|string|max:255',
        'answer' => 'required|string',
        'is_active' => 'nullable|boolean',  // Allow null for unchecked checkbox
    ]);

    // Manually convert 'is_active' to boolean (1 for checked, 0 for unchecked)
    $validated['is_active'] = $request->has('is_active') ? 1 : 0; // If checked, set to 1; else set to 0.

    // Log the validated data for debugging
    Log::info('Validated Data: ', $validated);

    // Log the current FAQ before updating
    Log::info('Current FAQ Details: ', $faq->toArray());

    // Attempt to update the FAQ with the validated data
    try {
        $faq->update($validated);
        Log::info('FAQ updated successfully.', $faq->toArray());
    } catch (\Exception $e) {
        // Log any error that occurs during the update process
        Log::error('Error updating FAQ: ' . $e->getMessage());
        return back()->with('error', 'Failed to update FAQ.');
    }

    // Return with a success message
    return back()->with('success', 'FAQ updated successfully.');
}




    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ deleted successfully.');
    }
}
