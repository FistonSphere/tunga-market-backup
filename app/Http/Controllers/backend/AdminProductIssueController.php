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

        $issue = ProductIssue::with('user')->findOrFail($request->issue_id);
        $issue->status = $request->status;
        $issue->save();

        // Send email to user
        Mail::raw("Dear {$issue->user->first_name},\n\n{$request->reply_message}\n\nStatus: " . ucfirst($issue->status), function($msg) use ($issue) {
            $msg->to($issue->user->email)
                ->subject('Response to Your Product Issue Report');
        });

        return back()->with('success', 'Reply sent successfully and status updated.');
    }

    // Fetch order items for modal
    public function getOrderItems($orderId)
    {
        $items = OrderItem::where('order_id', $orderId)
            ->with('product:id,name')
            ->get()
            ->map(function ($item) {
                return [
                    'product_name' => $item->product->name ?? 'Unknown',
                    'quantity' => $item->quantity,
                    'price' => number_format($item->price, 2)
                ];
            });

        return response()->json($items);
    }

}
