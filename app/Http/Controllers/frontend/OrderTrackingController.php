<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ProductIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderTrackingController extends Controller
{
public function index(Request $request)
{
    $status = $request->get('status');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');

    $orders = OrderItem::with(['order', 'product'])
        ->whereHas('order', function ($query) use ($status) {
            $query->where('user_id', auth()->id());

            // Status filter
            if ($status && strtolower($status) !== 'all') {
                $query->where('status', $status);
            }
        })
        // Date range filter on OrderItem's created_at
        ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('created_at', [
                $fromDate . ' 00:00:00',
                $toDate . ' 23:59:59'
            ]);
        })
        ->when($fromDate && !$toDate, function ($query) use ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        })
        ->when(!$fromDate && $toDate, function ($query) use ($toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        })
        ->paginate(5)
        ->appends([
            'status' => $status,
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ]);

    return view('frontend.order-tracking', [
        'orders'   => $orders,
        'status'   => $status ?? 'all',
        'fromDate' => $fromDate,
        'toDate'   => $toDate,
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

public function showById($orderIdentifier)
{
    // Determine if input is numeric ID or invoice number
    if (is_numeric($orderIdentifier)) {
        // It's an ID
        $order = Order::with(['items.product', 'items.variant', 'shippingAddress'])
            ->where('id', $orderIdentifier)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    } else {
        // It's an invoice number — fetch numeric ID first
        $order = Order::with(['items.product', 'items.variant', 'shippingAddress'])
            ->where('invoice_number', $orderIdentifier)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }

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

    // Fetch related orders
    $relatedOrders = Order::with(['items.product', 'items.variant', 'shippingAddress'])
        ->where('user_id', auth()->id())
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
                    'currency'     => 'Rwf',
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

public function searchByOrderNo($orderNo)
{
    $order = Order::with(['items.product', 'items.variant', 'shippingAddress', 'payment'])
        ->whereHas('items', function ($query) use ($orderNo) {
            $query->where('order_no', $orderNo);
        })
        ->where('user_id', auth()->id())
        ->first();

    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    }

    // Calculate subtotal
    $subtotal = $order->items->sum(fn($item) => $item->quantity * $item->price);

    $tax = round($subtotal * 0.10);
    $finalTotal = number_format($subtotal + $tax);

    $timeline = [
        [
            'title' => 'Order Confirmed',
            'timestamp' => $order->created_at->format('M d, Y \a\t h:i A'),
            'done' => true,
        ],
        [
            'title' => 'Processing',
            'timestamp' => $order->created_at->addMinutes(15)->format('M d, Y \a\t h:i A'),
            'done' => in_array($order->status, ['Processing','Shipped','Delivered']),
        ],
        [
            'title' => 'Shipped',
            'timestamp' => $order->created_at->addHours(2)->format('M d, Y \a\t h:i A'),
            'done' => in_array($order->status, ['Shipped','Delivered']),
        ],
        [
            'title' => 'Out for Delivery',
            'timestamp' => $order->created_at->addHours(20)->format('M d, Y \a\t h:i A'),
            'done' => ($order->status === 'Delivered'),
        ],
        [
            'title' => 'Delivered',
            'timestamp' => $order->updated_at->format('M d, Y \a\t h:i A'),
            'done' => ($order->status === 'Delivered'),
        ],
    ];

    return response()->json([
        'order' => $order,
        'subtotal' => $subtotal,
        'tax' => $tax,
        'finalTotal' => $finalTotal,
        'timeline' => $timeline,
    ]);
}

public function getOrderNo($id)
{

    $order = Order::with('items')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    $orderNo = $order->items->first()->order_no ?? null;

    return response()->json([
        'order_no' => $orderNo
    ]);
}

public function filter(Request $request)
{
    $status = $request->query('status');

    // Get authenticated user's orders
    $query = auth()->user()->orders()->with(['items.product', 'shippingAddress']);

    if ($status && $status !== 'all') {
        $query->where('status', $status);
    }

    $orders = $query->latest()->get();

    return response()->json([
        'orders' => $orders
    ]);
}

public function store(Request $request)
{
    $user = Auth::user();

    // ✅ Validate shipping address
    $request->validate([
        'shipping_address_id' => 'required|exists:shipping_addresses,id',
    ]);

    // ✅ Fetch cart items
    $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

    if ($cartItems->isEmpty()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Your cart is empty.'
        ], 400);
    }

    $currency = $cartItems->first()->product->currency ?? 'USD';

    // ✅ Generate unique order number
    $orderNumber = $this->generateUniqueOrderNumber();

    // ✅ Create the order
    $order = Order::create([
        'user_id' => $user->id,
        'order_number' => $orderNumber,
        'total' => 0,
        'currency' => $currency,
        'status' => 'Processing',
        'shipping_address_id' => $request->shipping_address_id,
        'payment_method' => 'Cash on Delivery',
    ]);

    // ✅ Add order items and calculate total
    $total = 0;
    foreach ($cartItems as $item) {
        $price = $item->product->discount_price ?? $item->product->price;
        $quantity = $item->quantity;

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $quantity,
            'price' => $price,
        ]);

        $total += $price * $quantity;
    }

    // ✅ Update total
    $order->update(['total' => $total]);

    // ✅ Optional invoice generation
    if (method_exists($order, 'generateInvoiceNumber')) {
        $order->generateInvoiceNumber();
    }

    // ✅ Generate unique COD transaction ID
    $transactionId = 'COD-' . strtoupper(uniqid());

    // ✅ Create payment record
    Payment::create([
        'order_id' => $order->id,
        'user_id' => $user->id,
        'payment_method' => 'Cash on Delivery',
        'amount' => $total,
        'currency' => $currency,
        'status' => 'pending',
        'transaction_id' => $transactionId,
    ]);

    // ✅ Clear the cart
    Cart::where('user_id', $user->id)->delete();

    // ✅ Return response
    return response()->json([
        'status' => 'success',
        'message' => 'Order placed successfully!',
        'order_number' => $orderNumber,
        'redirect_url' => route('thankyou', ['order' => $order->id]),
    ]);
}

/**
 * Generate a unique alphanumeric order number like ORD-A9F3ZB
 */
private function generateUniqueOrderNumber()
{
    do {
        $code = 'ORD-' . strtoupper(Str::random(6));
    } while (Order::where('order_number', $code)->exists());

    return $code;
}

public function thankYou(Order $order)
{
 $order->load(['items.product', 'shippingAddress', 'payment']);
 
    return view('frontend.thankyou', compact('order'));
}

}
