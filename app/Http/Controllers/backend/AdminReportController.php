<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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



public function customerGrowthReport(Request $request)
{
    /* ===============================
       FILTERS / DATE RANGE
    =============================== */
    $range = intval($request->input('range', 30));
    $startDate = $request->input('start_date')
        ? Carbon::parse($request->start_date)
        : now()->subDays($range);

    $endDate = $request->input('end_date')
        ? Carbon::parse($request->end_date)
        : now();

    $search = $request->input('search');
    $role   = $request->input('role'); // yes/no for admin


    /* ===============================
       BASE USER QUERY (SEARCH + ROLE)
    =============================== */
    $userQuery = User::query();

    if ($role) {
        $userQuery->where('is_admin', $role);
    }

    if ($search) {
        $userQuery->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }


    /* ===============================
       1) CUSTOMER GROWTH (PER DAY)
    =============================== */
    $customerGrowth = $userQuery
        ->whereBetween('created_at', [
            $startDate->copy()->startOfDay(),
            $endDate->copy()->endOfDay()
        ])
        ->selectRaw("DATE(created_at) as date, COUNT(*) as count")
        ->groupBy(DB::raw("DATE(created_at)"))
        ->orderBy(DB::raw("DATE(created_at)"))
        ->get();


    /* ===============================
       2) ACTIVE USERS PER DAY
    =============================== */
    $activityQuery = UserActivityLog::query()
        ->whereBetween('created_at', [
            $startDate->copy()->startOfDay(),
            $endDate->copy()->endOfDay()
        ]);

    $activeUsers = $activityQuery
        ->selectRaw("DATE(created_at) as date, COUNT(DISTINCT user_id) as count")
        ->groupBy(DB::raw("DATE(created_at)"))
        ->orderBy(DB::raw("DATE(created_at)"))
        ->get();


    /* ===============================
       3) SUMMARY
    =============================== */
    $summary = [
        'total_customers' => User::count(),
        'new_customers'   => $userQuery->whereBetween(
                                'created_at',
                                [$startDate->copy()->startOfDay(), $endDate->copy()->endOfDay()]
                            )->count(),
        'active_users'    => $activityQuery->distinct('user_id')->count('user_id'),
        'retention_rate'  => $this->calculateRetentionRate($startDate, $endDate),
    ];


    /* ===============================
       4) TOP ACTIVE USERS
    =============================== */
    $topActiveUsers = UserActivityLog::select('user_id', DB::raw("COUNT(*) as activity_count"))
        ->whereBetween('created_at', [
            $startDate->copy()->startOfDay(),
            $endDate->copy()->endOfDay()
        ])
        ->groupBy('user_id')
        ->orderByDesc('activity_count')
        ->take(10)
        ->get()
        ->load('user');


    /* ===============================
       5) MOST VISITED PAGES
    =============================== */
    $visitedPages = UserActivityLog::select('page_visited', DB::raw("COUNT(*) as visits"))
        ->whereBetween('created_at', [
            $startDate->copy()->startOfDay(),
            $endDate->copy()->endOfDay()
        ])
        ->groupBy('page_visited')
        ->orderByDesc('visits')
        ->take(10)
        ->get();


    /* ===============================
       6) DEVICE & BROWSER STATS
    =============================== */
    $deviceStats = UserActivityLog::select('device', DB::raw("COUNT(*) as count"))
        ->whereBetween('created_at', [
            $startDate->copy()->startOfDay(),
            $endDate->copy()->endOfDay()
        ])
        ->groupBy('device')
        ->orderByDesc('count')
        ->get();

    $browserStats = UserActivityLog::select('browser', DB::raw("COUNT(*) as count"))
        ->whereBetween('created_at', [
            $startDate->copy()->startOfDay(),
            $endDate->copy()->endOfDay()
        ])
        ->groupBy('browser')
        ->orderByDesc('count')
        ->get();


    /* ===============================
       7) WORLD MAP (COUNTRY COUNTS)
    =============================== */
    $locationData = UserActivityLog::whereBetween('created_at', [
            $startDate->copy()->startOfDay(),
            $endDate->copy()->endOfDay()
        ])
        ->whereNotNull('location')
        ->get()
        ->map(function ($row) {
            $loc = trim($row->location);

            if (str_contains($loc, ',')) {
                $parts = array_map('trim', explode(',', $loc));
                return strtolower(end($parts)); // country only
            }

            return strtolower($loc);
        })
        ->filter()
        ->countBy()
        ->map(function ($val, $key) {
            return ['name' => ucwords($key), 'value' => $val];
        })
        ->values();


    /* ===============================
       8) HEATMAP (HOUR × DAY)
    =============================== */
    $hourly = UserActivityLog::whereBetween('created_at', [
            $startDate->copy()->startOfDay(),
            $endDate->copy()->endOfDay()
        ])
        ->selectRaw("HOUR(created_at) as hour, DAYOFWEEK(created_at) as weekday, COUNT(*) as count")
        ->groupBy('hour', 'weekday')
        ->get();

    // Format for ECharts
    $heatmapData = $hourly->map(function ($r) {
        return [
            intval($r->weekday) - 1, // 0–6
            intval($r->hour),
            intval($r->count)
        ];
    })->values();


    /* ===============================
       9) COHORT RETENTION (WEEKLY)
    =============================== */
    $cohortStart = $startDate->copy()->startOfWeek();
    $cohortEnd   = $endDate->copy()->endOfWeek();

    $usersByCohort = User::selectRaw("
            DATE(created_at - INTERVAL (DAYOFWEEK(created_at)-1) DAY) as cohort_week,
            id
        ")
        ->whereBetween('created_at', [$cohortStart, $cohortEnd])
        ->get()
        ->groupBy('cohort_week');

    $cohortMatrix = [];
    $cohortWeeks = $usersByCohort->keys()->sort()->values();

    foreach ($cohortWeeks as $cohortWeek) {
        $cohortUsers = $usersByCohort[$cohortWeek]->pluck('id')->toArray();
        $weekStart = Carbon::parse($cohortWeek);
        $cohortSize = count($cohortUsers);

        $row = [
            'cohort_week' => $cohortWeek,
            'size' => $cohortSize,
            'retention' => []
        ];

        $weeksSpan = $cohortEnd->diffInWeeks($weekStart) + 1;

        for ($w = 0; $w < $weeksSpan; $w++) {
            $from = $weekStart->copy()->addWeeks($w)->startOfWeek();
            $to   = $from->copy()->endOfWeek();

            $retained = UserActivityLog::whereIn('user_id', $cohortUsers)
                ->whereBetween('created_at', [$from, $to])
                ->distinct('user_id')
                ->count('user_id');

            $row['retention'][] = $cohortSize
                ? round(($retained / $cohortSize) * 100, 1)
                : 0;
        }

        $cohortMatrix[] = $row;


    }


    /* ===============================
       10) AI INSIGHTS
    =============================== */
    $insights = $this->generateAIInsightsForUsers($summary, $customerGrowth, $activeUsers);


    /* ===============================
       RETURN BLADE
    =============================== */
    return view('admin.reports.customer_growth', compact(
        'range','startDate','endDate','search','role',
        'summary','customerGrowth','activeUsers','topActiveUsers','visitedPages',
        'deviceStats','browserStats','locationData','heatmapData','cohortMatrix','cohortWeeks','insights'
    ));
}

// HELPER: RETENTION RATE (simple version)
private function calculateRetentionRate($startDate, $endDate)
{
    $durationDays = $startDate->diffInDays($endDate) ?: 1;
    $prevStart = $startDate->copy()->subDays($durationDays);
    $prevEnd = $startDate->copy()->subDay();

    $prev = UserActivityLog::whereBetween('created_at', [$prevStart, $prevEnd])
        ->distinct('user_id')->count('user_id');
    $current = UserActivityLog::whereBetween('created_at', [$startDate, $endDate])
        ->distinct('user_id')->count('user_id');

    if ($prev == 0) return $current > 0 ? 100 : 0;
    return round(($current / $prev) * 100, 1);
}

private function generateAIInsightsForUsers($summary, $customerGrowth, $activeUsers)
{
    // small heuristic insights
    $growthCount = $summary['new_customers'] ?? 0;
    $active = $summary['active_users'] ?? 0;

    $note = $growthCount > 50 ? "Great acquisition: {$growthCount} new users in the period."
          : ($growthCount > 0 ? "Positive acquisition: {$growthCount} new users." : "Low new user signups this period.");

    if ($active < max(10, intval($growthCount * 0.2))) {
        $note .= " Activity seems low relative to signups — consider onboarding improvements.";
    }

    return [

        'note' => $note,
        'trend' => $growthCount > 0 ? 'up' : 'down',
        'growth_rate' => $growthCount
    ];
}

}
