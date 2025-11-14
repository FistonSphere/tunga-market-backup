<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Browsershot\Browsershot;

class AdminReportController extends Controller
{
    /**
     * Show the Purchase Order Report Page
     */
    public function purchaseOrderReport(Request $request)
    {
        // Default date range → last 30 days
        $startDate = $request->start_date
            ? Carbon::parse($request->start_date)
            : now()->subDays(30);

        $endDate = $request->end_date
            ? Carbon::parse($request->end_date)
            : now();

        $status = $request->status;
        $paymentMethod = $request->payment_method;

        // QUERY
        $orders = Order::with(['user', 'payment', 'items'])
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($paymentMethod, fn($q) => $q->where('payment_method', $paymentMethod))
            ->orderByDesc('created_at')
            ->paginate(20);

        // SUMMARY BOXES (for charts & totals)
        $summary = [
            'total_orders'       => $orders->total(),
            'total_revenue'      => $orders->sum('total'),
            'total_tax'          => $orders->sum('tax_amount'),
            'paid_orders'        => $orders->where('payment.status', 'paid')->count(),
            'pending_orders'     => $orders->where('status', 'Pending')->count(),
            'delivered_orders'   => $orders->where('status', 'Delivered')->count(),
        ];

        return view('admin.reports.purchase_orders.index', compact(
            'orders',
            'startDate',
            'endDate',
            'status',
            'paymentMethod',
            'summary'
        ));
    }


     public function exportPurchaseOrdersPDF(Request $request)
    {
        // Use same filter as above
        $startDate = $request->query('start_date') ? Carbon::parse($request->start_date) : now()->subMonth();
        $endDate   = $request->query('end_date') ? Carbon::parse($request->end_date) : now();
        $status    = $request->query('status', '');
        $paymentMethod = $request->query('payment_method', '');

        $ordersQuery = Order::with('user', 'items', 'payment')
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()]);

        if ($status) $ordersQuery->where('status', $status);
        if ($paymentMethod) $ordersQuery->where('payment_method', $paymentMethod);

        $orders = $ordersQuery->orderBy('created_at', 'desc')->get();

        $summary = [
            'total_orders' => $ordersQuery->count(),
            'total_revenue' => $ordersQuery->sum('total'),
            'total_tax' => $ordersQuery->sum('tax_amount'),
            'delivered_orders' => $ordersQuery->where('status', 'Delivered')->count(),
        ];

        // Render HTML first
        $html = view('admin.reports.purchase_orders.pdf', compact('orders', 'summary', 'startDate', 'endDate', 'status', 'paymentMethod'))->render();

        // Generate PDF via headless Chrome
        return Browsershot::html($html)
            ->setOption('args', ['--no-sandbox'])
            ->format('A4')
            ->showBackground()
            ->margins(10, 10, 10, 10)
            ->download('purchase_orders_report_' . now()->format('Ymd_His') . '.pdf');
    }
}
