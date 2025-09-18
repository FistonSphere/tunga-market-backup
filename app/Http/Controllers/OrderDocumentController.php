<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class OrderDocumentController extends Controller
{
    public function invoice(Order $order)
    {
        $pdf = PDF::loadView('frontend.orders.invoice', compact('order'));
        return $pdf->stream("invoice-{$order->id}.pdf");
    }

    public function downloadInvoice(Order $order)
    {
        $pdf = PDF::loadView('frontend.orders.invoice', compact('order'));
        return $pdf->download("invoice-{$order->id}.pdf");
    }

    public function receipt(Order $order)
    {
        $pdf = PDF::loadView('documents.receipt', compact('order'));
        return $pdf->stream("receipt-{$order->id}.pdf");
    }

    public function downloadReceipt(Order $order)
    {
        $pdf = PDF::loadView('documents.receipt', compact('order'));
        return $pdf->download("receipt-{$order->id}.pdf");
    }
}

