<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminEnquiryController extends Controller
{
   public function index()
{
    $products = Product::where('status', 'active')->get();
    $enquiries = Enquiry::with('product')->orderBy('created_at', 'desc')->paginate(10);
    return view('admin.produhangcts.enquiries', compact('enquiries','products'));
}
public function EnquiriesDestroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return response()->json(['status' => 'success', 'message' => 'Enquiry deleted successfully.']);
    }

 public function showConversation(Enquiry $enquiry)
    {
        $enquiry->load(['replies.user', 'product']);
        return response()->json($enquiry);
    }

    public function sendReply(Request $request, Enquiry $enquiry)
    {
        $validated = $request->validate(['message' => 'required|string']);

        $reply = $enquiry->replies()->create([
            'user_id' => auth()->id(),
            'message' => $validated['message'],
        ]);

        // You could also send an email notification to the user here

        return response()->json([
            'status' => 'success',
            'message' => 'Reply sent successfully.',
            'reply' => [
                'message' => $reply->message,
                'user' => auth()->user()->first_name ?? 'Admin',
                'created_at' => $reply->created_at->diffForHumans()
            ]
        ]);
    }
}
