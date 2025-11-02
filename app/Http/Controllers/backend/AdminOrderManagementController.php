<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderManagementController extends Controller
{
   public function Orderlist(Request $request)
{
    $orders = Order::with(['user', 'items.product', 'payment', 'shippingAddress'])
        ->when($request->search, function ($query, $search) {
            $query->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
        })
        ->when($request->status, fn($q, $status) => $q->where('status', $status))
        ->withCount('items')
        ->orderByDesc('created_at')
        ->paginate(10)
        ->appends($request->only('search', 'status'));

    return view('admin.orders.index', compact('orders'));
}


public function show($id)
{
    $order = Order::with([
        'user',
        'items.product',
        'shippingAddress',
        'payment'
    ])->findOrFail($id);

    return response()->json([
        'success' => true,
        'data' => [
            'id' => $order->id,
            'invoice_number' => $order->invoice_number,
            'status' => $order->status,
            'payment_method' => $order->payment_method,
            'total' => $order->total,
            'currency' => $order->currency,
            'created_at' => $order->created_at->toDateTimeString(),
            'user' => $order->user,
            'shipping_address' => $order->shippingAddress,
            'payment' => $order->payment,
            'items' => $order->items,
        ],
    ]);
}

}
