<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   public function paymentSuccess(Order $order)
{
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    // Ensure receipt number is generated
    $order->generateReceiptNumber();

    // Redirect to receipt page
    return redirect()->route('orders.receipt', $order->id)
                     ->with('success', 'Payment successful! Receipt generated.');
}

}
