<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
   public function index()
{
    $cartItems = Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')
            ->with('error', 'Your cart is empty!');
    }

    // Subtotal
    $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);

    // Bulk discount (reusing your cart logic)
    $totalItems = $cartItems->sum('quantity');
    // $bulkDiscount = ($totalItems > 5) ? $subtotal * 0.1 : 0;

    // Tax (7.2%)
    $tax = ($subtotal) * 0.1;
//discount
$discount = $subtotal > 500 ? $subtotal * 0.1 : 0;
//shipping
// $shipping = 12.99;
    // Final total
    $total = $subtotal + $tax;
 // ✅ Get user saved addresses
    $addresses = ShippingAddress::where('user_id', Auth::id())->get();
    return view('frontend.checkout', compact(
        'cartItems',
        'subtotal',
        'tax',
        'discount',
        'total',
        'totalItems',
        'addresses'
    ));
}


     public function storeShipping(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city'    => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
        ]);

        session(['checkout.shipping' => $request->all()]);

        return redirect()->route('checkout')->with('step', 2);
    }

    // Step 3: Store Payment
    public function storePayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        session(['checkout.payment' => $request->all()]);

        return redirect()->route('checkout.index')->with('step', 3);
    }

     // Step 4: Complete Order
    public function complete()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $shipping = session('checkout.shipping');
        $payment = session('checkout.payment');

        // Create Order
        $order = Order::create([
            'user_id'   => Auth::id(),
            'total'     => $cartItems->sum(fn($item) => $item->quantity * $item->price),
            'currency'  => 'Rwf',
            'status'    => 'pending',
            'address'   => $shipping['address'],
            'city'      => $shipping['city'],
            'country'   => $shipping['country'],
            'phone'     => $shipping['phone'],
            'payment_method' => $payment['payment_method'] ?? 'cash',
        ]);

        // Create Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->price,
            ]);
        }

        // Clear cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function storeAddress(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'address_line1' => 'required|string|max:255',
        'address_line2' => 'nullable|string|max:255',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'postal_code' => 'required|string|max:20',
        'country' => 'required|string|max:100',
        'phone' => 'required|string|max:20',
        'company' => 'nullable|string|max:100',
    ]);

    $validated['user_id'] = Auth::id();
    if ($request->has('is_default')) {
        ShippingAddress::where('user_id', Auth::id())->update(['is_default' => false]);
        $validated['is_default'] = true;
    }

    ShippingAddress::create($validated);

    return redirect()->route('checkout.index')->with('success', 'New address added successfully.');
}

}
