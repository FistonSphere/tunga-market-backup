<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    $bulkDiscount = $subtotal > 200 ? $subtotal * 0.10 : 0;
    $shipping    = 0;           // adjust if you have shipping rules
    $tax= $subtotal * 0.1;

    // dd($subtotal);
//discount
$discount = $subtotal > 500 ? $subtotal * 0.1 : 0;
//shipping
// $shipping = 12.99;
    // Final total
    $total       = $subtotal - $bulkDiscount + $shipping + $tax;
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

 public function store(Request $request)
{
    Log::info('--- Shipping Address Store Started ---');
    Log::info('Incoming request data:', $request->all());

    try {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'address_line1' => 'required|string|max:255',
            'city'          => 'required|string|max:255',
            'state'         => 'required|string|max:255',
            'postal_code'   => 'nullable|string|max:20',
            'country'       => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
        ]);
        Log::info('Validation passed');

        $userId = Auth::id();
        Log::info('Authenticated user ID:', [$userId]);

        // Reset other addresses
        $updated = ShippingAddress::where('user_id', $userId)->update(['is_default' => 0]);
        Log::info('Reset default addresses:', ['count' => $updated]);

        // Create new address
        $shipping = ShippingAddress::create([
            'user_id'       => $userId,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'company'       => $request->company,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city'          => $request->city,
            'state'         => $request->state,
            'postal_code'   => $request->postal_code,
            'country'       => $request->country,
            'phone'         => $request->phone,
            'is_default'    => 1,
        ]);
        Log::info('New Shipping Address created:', $shipping->toArray());

        Log::info('--- Shipping Address Store Completed ---');

        // 🔹 If AJAX request → return JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Shipping address saved successfully!',
                'data'    => $shipping
            ]);
        }

        // Normal form request
        return redirect()->back()->with('success', 'Shipping address saved successfully!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        }
        throw $e; // let Laravel handle normal request
    } catch (\Exception $e) {
        Log::error('Error in ShippingAddress store:', [
            'message' => $e->getMessage(),
            'trace'   => $e->getTraceAsString()
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while saving address.',
            ], 500);
        }
        return redirect()->back()->withErrors('Something went wrong while saving address.');
    }
}

public function editShippingAddress($id)
    {
        $address = ShippingAddress::where('id', $id)
            ->where('user_id', Auth::id()) // security check
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }
public function updateShippingAddress(Request $request, $id)
    {
        // Validate request
        $validated = $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'company'      => 'nullable|string|max:150',
            'address_line1'=> 'required|string|max:255',
            'address_line2'=> 'nullable|string|max:255',
            'city'         => 'required|string|max:100',
            'state'        => 'required|string|max:100',
            'postal_code'  => 'nullable|string|max:20',
            'country'      => 'required|string|max:100',
            'phone'        => 'required|string|max:20',
        ]);

        // Find address for current user
        $address = ShippingAddress::where('id', $id)
            ->where('user_id', Auth::id()) // security check
            ->firstOrFail();

        // Update the record
        $address->update($validated);

        // Return success JSON for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Shipping address updated successfully!',
            'address' => $address
        ]);
    }
}
