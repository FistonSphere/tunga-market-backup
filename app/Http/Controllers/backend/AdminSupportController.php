<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class AdminSupportController extends Controller
{
   public function index(Request $request)
    {
        $query = ContactRequest::query();

        // Filter by status or priority
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($priority = $request->get('priority')) {
            $query->where('priority', $priority);
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('subject', 'like', "%$search%");
            });
        }

        $requests = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.support.partials.table', compact('requests'))->render(),
            ]);
        }

        return view('admin.support.contact-request', compact('requests'));
    }

public function show(ContactRequest $contact)
{
    // Return partial view for AJAX
    if (request()->ajax()) {
        return view('admin.support.partials.view', compact('contact'))->render();
    }

    // Fallback (in case accessed directly)
    return redirect()->route('admin.support.contactRequests');
}

    public function updateStatus(Request $request, ContactRequest $contact)
    {
        $contact->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }
}
