<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class OrderDocumentController extends Controller
{
    public function invoice(Order $order)
    {
        // Ensure only owner (or authorized user) can view
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Make sure invoice number exists and persisted
        $order->generateInvoiceNumber();

        // Eager load relations we use in view
        $order->load(['items.product', 'shippingAddress', 'user']);

        // Compute totals
        $subtotal = $order->items->sum(function ($item) {
            return ($item->price * $item->quantity);
        });

        $taxRate = 0.10; // 10% tax (as requested)
        $tax = round($subtotal * $taxRate, 2);
        $finalTotal = round($subtotal + $tax, 2);


        return view('frontend.orders.invoice', compact('order', 'subtotal', 'tax', 'finalTotal', 'taxRate'));
    }
    public function downloadInvoice(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->generateInvoiceNumber();
        $order->load(['items.product', 'shippingAddress', 'user']);

        $subtotal = $order->items->sum(function ($item) {
            return ($item->price * $item->quantity);
        });

        $taxRate = 0.10;
        $tax = round($subtotal * $taxRate, 2);
        $finalTotal = round($subtotal + $tax, 2);

        // For now return the same view (user can use browser Print -> Save as PDF)
        return view('frontend.orders.invoice', compact('order', 'subtotal', 'tax', 'finalTotal', 'taxRate'));
    }

    public function receipt(Order $order)
{
    // Ensure only owner (or authorized user) can view
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    // Eager load relations
    $order->load(['items.product', 'shippingAddress', 'user', 'payment']);
$order->generateReceiptNumber();
    // Compute totals
    $subtotal = $order->items->sum(function ($item) {
        return ($item->price * $item->quantity);
    });

    $taxRate = 0.10; // 10% tax
    $tax = round($subtotal * $taxRate, 2);
    $finalTotal = round($subtotal + $tax, 2);

    return view('frontend.orders.receipt', compact(
        'order',
        'subtotal',
        'tax',
        'finalTotal',
        'taxRate'
    ));
}

public function downloadReceipt(Order $order)
{
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    $order->load(['items.product', 'shippingAddress', 'user', 'payment']);
    
    $subtotal = $order->items->sum(function ($item) {
        return ($item->price * $item->quantity);
    });

    $taxRate = 0.10;
    $tax = round($subtotal * $taxRate, 2);
    $finalTotal = round($subtotal + $tax, 2);

    // For now return same view; user can Print -> Save as PDF
    return view('frontend.orders.receipt', compact(
        'order',
        'subtotal',
        'tax',
        'finalTotal',
        'taxRate'
    ));
}

}
