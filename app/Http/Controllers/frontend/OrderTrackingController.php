<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderTrackingController extends Controller
{
   public function index()
   {
    $orders = OrderItem::with(['order', 'product'])
        ->whereHas('order', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->paginate(5);


       // Logic to show the order tracking page
       return view('frontend.order-tracking',[
        'orders' => $orders
       ]);
   }

public function show($orderId)
{
    $order = Order::with(['items.product', 'items.variant', 'shippingAddress'])
        ->where('id', $orderId)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // Calculate subtotal
    $subtotal = $order->items->sum(fn($item) => $item->quantity * $item->price);

    // Tax (10%)
    $tax = $subtotal * 0.10;

    // Final total
    $finalTotal = $subtotal + $tax;

    // Build delivery timeline steps dynamically
    $timeline = [
        [
            'title' => 'Order Confirmed',
            'message' => 'Your order has been confirmed and payment processed',
            'timestamp' => $order->created_at->format('M d, Y \a\t h:i A'),
            'done' => true,
        ],
        [
            'title' => 'Processing',
            'message' => 'Order is being prepared for shipment',
            'timestamp' => $order->created_at->addMinute(15)->format('M d, Y \a\t h:i A'),
            'done' => in_array($order->status, ['Processing','Delivered']),
        ],
        [
            'title' => 'Shipped',
            'message' => 'Package is on the way',
            'timestamp' => $order->created_at->addHours(2)->format('M d, Y \a\t h:i A'),
            'done' => in_array($order->status, ['Delivered']),
        ],
        [
            'title' => 'Out for Delivery',
            'message' => 'Package is out for delivery',
            'timestamp' => $order->created_at->addHours(20)->format('M d, Y \a\t h:i A'),
            'done' => ($order->status === 'Delivered'),
        ],
        [
            'title' => 'Delivered',
            'message' => 'Package delivered successfully',
            'timestamp' => $order->updated_at->format('M d, Y \a\t h:i A'),
            'done' => ($order->status === 'Delivered'),
        ],
    ];
 $relatedOrders = Order::with(['items.product', 'items.variant', 'shippingAddress'])->where('user_id', auth()->id())
        ->where('id', '!=', $order->id)
        ->take(3)
        ->get();

    return view('frontend.orders.show', [
        'order' => $order,
        'subtotal' => $subtotal, 
        'tax' => $tax,
        'finalTotal' => $finalTotal,
        'timeline' => $timeline,
        'relatedOrders' => $relatedOrders,
    ]);
}
public function reorder(Order $order)
{
    try {
        foreach ($order->items as $item) {
            $existingCart = DB::table('carts')
                ->where('user_id', auth()->id())
                ->where('product_id', $item->product_id)
                ->first();

            if ($existingCart) {
                // Update quantity if already exists
                DB::table('carts')
                    ->where('id', $existingCart->id)
                    ->update([
                        'quantity'   => $existingCart->quantity + $item->quantity,
                        'price'      => $item->price, // keep latest price
                        'updated_at' => now(),
                    ]);
            } else {
                // Insert new record
                DB::table('carts')->insert([
                    'user_id'      => auth()->id(),
                    'product_id'   => $item->product_id,
                    'quantity'     => $item->quantity,
                    'price'        => $item->price,
                    'currency'     => 'Rwf', // default currency for Rwanda
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to reorder items. ' . $e->getMessage()
        ]);
    }
}

public function reportIssue(Request $request, Order $order)
{
    // ensure the authenticated user owns the order
    if ($order->user_id !== auth()->id()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    $data = $request->validate([
        'product_id' => 'required|integer|exists:products,id',
        'message'    => 'required|string|max:2000',
    ]);

    // ensure product is part of this order
    $item = $order->items()->where('product_id', $data['product_id'])->first();
    if (! $item) {
        return response()->json(['success' => false, 'message' => 'Product not found in this order.'], 404);
    }

    $issue = ProductIssue::create([
        'order_id'   => $order->id,
        'product_id' => $data['product_id'],
        'user_id'    => auth()->id(),
        'message'    => $data['message'],
        'status'     => 'pending',
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Your issue has been reported. Our support team will reach out soon.',
        'issue'   => $issue,
    ]);
}


}
