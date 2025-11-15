<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
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


public function printPurchaseOrders(Request $request)
{
    $startDate = $request->query('start_date') ? Carbon::parse($request->start_date) : now()->subMonth();
    $endDate = $request->query('end_date') ? Carbon::parse($request->end_date) : now();
    $status = $request->query('status') ?? null;
    $paymentMethod = $request->query('payment_method') ?? null;

    $ordersQuery = Order::with(['user', 'payment', 'items'])
        ->whereBetween('created_at', [$startDate, $endDate]);

    if ($status) {
        $ordersQuery->where('status', $status);
    }

    if ($paymentMethod) {
        $ordersQuery->where('payment_method', $paymentMethod);
    }

    $orders = $ordersQuery->orderBy('created_at', 'desc')->get();

    $summary = [
        'total_orders' => $orders->count(),
        'total_revenue' => $orders->sum('total'),
        'total_tax' => $orders->sum('tax_amount'),
        'delivered_orders' => $orders->where('status', 'Delivered')->count(),
    ];

    return view('admin.reports.purchase_orders.pdf', compact('orders', 'summary', 'startDate', 'endDate', 'status', 'paymentMethod'));
}


public function salesRevenueReport(Request $request)
{
    // Filters
    $range = $request->input('range', 30);
    $startDate = now()->subDays($range);
    $endDate = now();

    // CURRENT PERIOD
    $revenueData = Order::where('status', 'Delivered')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->selectRaw('DATE(created_at) as date, SUM(total) as total_revenue')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // PREVIOUS PERIOD (for comparison)
    $prevStart = now()->subDays($range * 2);
    $prevEnd   = now()->subDays($range);

    $previousPeriod = Order::where('status', 'Delivered')
        ->whereBetween('created_at', [$prevStart, $prevEnd])
        ->selectRaw('DATE(created_at) as date, SUM(total) as total_revenue')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // ============================
    // ✅ Top Customers (Fixed)
    // ============================
    $topCustomers = Order::where('status', 'Delivered')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->selectRaw("users.first_name, users.last_name, SUM(orders.total) as spent")
        ->groupBy('users.first_name', 'users.last_name')
        ->orderByDesc('spent')
        ->limit(5)
        ->get();

    // ============================
    // ✅ Revenue by Payment Method (Fixed)
    // ============================
    $paymentMethods = Payment::join('orders', 'orders.id', '=', 'payments.order_id')
        ->where('orders.status', 'Delivered')
        ->selectRaw('payments.payment_method, SUM(payments.amount) as total')
        ->groupBy('payments.payment_method')
        ->get();

    // ============================
    // ✅ Revenue by Product Category (Fixed)
    // ============================
    $categoryRevenue = OrderItem::join('products', 'products.id', '=', 'order_items.product_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('orders', 'orders.id', '=', 'order_items.order_id')
        ->where('orders.status', 'Delivered')
        ->selectRaw('categories.name as category, SUM(order_items.quantity * order_items.price) as total')
        ->groupBy('categories.name')
        ->get();

    // ============================
    // Summary
    // ============================
    $summary = [
        'total_revenue'    => $revenueData->sum('total_revenue'),
        'average_per_day'  => $revenueData->avg('total_revenue'),
        'highest_day'      => $revenueData->max('total_revenue'),
        'lowest_day'       => $revenueData->min('total_revenue'),
        'period_range'     => $range,
    ];

    // AI insights (simple but effective summary generation)
    $insights = $this->generateInsights($summary, $previousPeriod);

    return view('admin.reports.sales_revenue', compact(
        'summary', 'revenueData', 'previousPeriod', 'range',
        'topCustomers', 'paymentMethods', 'categoryRevenue', 'insights'
    ));
}


private function generateInsights($summary, $previousPeriod)
{
    $prevTotal = $previousPeriod->sum('total_revenue');
    $currentTotal = $summary['total_revenue'];

    if ($prevTotal == 0) {
        $growth = 100;
    } else {
        $growth = (($currentTotal - $prevTotal) / $prevTotal) * 100;
    }

    return [
        'growth_rate' => round($growth, 2),
        'trend'       => $growth >= 0 ? 'up' : 'down',
        'note'        => $growth >= 0
            ? "Sales are increasing compared to the previous period."
            : "Sales declined this period. Consider checking slow categories.",
    ];
}



}
