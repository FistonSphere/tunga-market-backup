<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\ProductIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminProductIssueController extends Controller
{
   
   public function index(){
   $issues = ProductIssue::with('order','user','product')->get();
   
    return view('admin.product-issues.index',compact('issues'));
   }

public function reply(Request $request)
{
    $request->validate([
        'issue_id' => 'required|exists:product_issues,id',
        'reply_message' => 'required|string',
        'status' => 'required|in:pending,resolved'
    ]);

    // Fetch the issue with all related data for a richer email
    $issue = ProductIssue::with(['user', 'product', 'order'])->findOrFail($request->issue_id);

    // Update issue status
    $issue->update(['status' => $request->status]);

    // Prepare data
    $user = $issue->user;
    $subject = "Response to Your Product Issue – Tunga Market";

    // Prepare email body (rendering the Blade view)
    $emailContent = view('emails.issue_reply', [
        'user' => $user,
        'reply' => $request->reply_message,
        'status' => ucfirst($request->status),
        'issue' => $issue
    ])->render();

    // Send the email (modern method)
    Mail::send([], [], function ($message) use ($user, $subject, $emailContent) {
        $message->to($user->email)
            ->subject($subject)
            ->html($emailContent); // ✅ Correct way for HTML body
    });

    return back()->with('success', 'Reply sent successfully and status updated.');
}




    // Fetch order items for modal
    public function getOrderItems($orderId)
    {
        $items = OrderItem::where('order_id', $orderId)
            ->with('product:id,name,main_image')
            ->get()
            ->map(function ($item) {
                return [
                    'order_no'=>$item->order_no ?? '',
                    'product_image' => $item->product->main_image,
                    'product_name' => $item->product->name ?? 'Unknown',
                    'quantity' => $item->quantity,
                    'price' => number_format($item->price)
                ];
            });
        return response()->json($items);
    }

}
