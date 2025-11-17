<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class AdminInventoryController extends Controller
{
    public function index(Request $request)
    {
        $range = (int) $request->input('range', 30);
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : now()->subDays($range);
        $endDate   = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : now();

        // Load categories for filter dropdown (if present)
        $categories = class_exists(Category::class) ? Category::orderBy('name')->get() : collect([]);

        // Minimal initial data — heavy aggregations come from /data endpoint (cached)
        $products = Product::with(['category', 'units'])->orderBy('name')->take(200)->get();

        // Summary KPI prelims (lightweight)
        $totalProducts = Product::count();
        $totalInventoryValue = Product::select(DB::raw('SUM(stock_quantity * COALESCE(price,0)) as value'))->value('value') ?? 0;
        $lowStockCount = Product::where('stock_quantity', '>', 0)->where('stock_quantity', '<=', 10)->count();
        $outOfStockCount = Product::where('stock_quantity', '<=', 0)->count();

        return view('admin.reports.inventory', compact(
            'range','startDate','endDate','products','categories',
            'totalProducts','totalInventoryValue','lowStockCount','outOfStockCount'
        ));
    }

    /**
     * AJAX JSON endpoint that returns the analytics data (cached).
     */
    public function data(Request $request)
    {
        // filters
        $range = (int) $request->input('range', 30);
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : now()->subDays($range);
        $endDate   = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : now();
        $categoryId = $request->input('category_id');
        $search = $request->input('search');

        // cache key
        $key = 'inventory_data_' . md5($range . '|' . $startDate . '|' . $endDate . '|' . $categoryId . '|' . $search);

        $payload = Cache::remember($key, 10, function () use ($startDate, $endDate, $categoryId, $search) {
            // 1) Products list (with stock)
            $productQuery = Product::query()->with(['category', 'units']);

            if ($categoryId) $productQuery->where('category_id', $categoryId);
            if ($search) $productQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });

            $products = $productQuery->orderBy('stock_quantity', 'desc')->get();

            // 2) Sales summary per product (in date range)
            // Join order_items -> orders to restrict delivered/completed orders if status exists
            $orderItemQuery = OrderItem::query()
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->whereBetween('orders.created_at', [$startDate->startOfDay(), $endDate->endOfDay()]);

            // optionally restrict to delivered/completed
            $orderItemQuery->where(function ($q) {
                // If you use 'status' for orders, consider delivered/complete statuses.
                // Keep flexible: only filter if the column exists.
                if (SchemaHasColumn('orders', 'status')) {
                    $q->whereIn('orders.status', ['Delivered', 'delivered','Completed','completed','paid','Paid']);
                }
            });

            // Summarize sold quantities and revenue per product
            $salesSummary = $orderItemQuery
                ->select('order_items.product_id',
                         DB::raw('SUM(order_items.quantity) as total_sold'),
                         DB::raw('SUM(order_items.quantity * order_items.price) as revenue'))
                ->groupBy('order_items.product_id')
                ->orderByDesc('total_sold')
                ->get()
                ->keyBy('product_id');

            // 3) Top sold products (by total_sold)
            $topSellers = $salesSummary->sortByDesc('total_sold')->take(10)->values()->map(function($r) {
                return [
                    'product_id' => $r->product_id,
                    'total_sold' => (int)$r->total_sold,
                    'revenue' => (float)$r->revenue,
                ];
            });

            // 4) Movement trend (daily sold items)
            $dailySold = OrderItem::join('orders', 'orders.id', '=', 'order_items.order_id')
                ->whereBetween('orders.created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                ->select(DB::raw('DATE(orders.created_at) as date'), DB::raw('SUM(order_items.quantity) as sold'))
                ->groupBy(DB::raw('DATE(orders.created_at)'))
                ->orderBy(DB::raw('DATE(orders.created_at)'))
                ->get();

            // 5) Stock levels array for chart
            $stockLevels = $products->map(function ($p) use ($salesSummary) {
                $sold = isset($salesSummary[$p->id]) ? (int)$salesSummary[$p->id]->total_sold : 0;
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'sku' => $p->sku,
                    'category' => $p->category?->name ?? null,
                    'unit' => $p->units?->name ?? null,
                    'stock_quantity' => (int)$p->stock_quantity,
                    'price' => (float)$p->price,
                    'stock_value' => (float)($p->stock_quantity * ($p->price ?? 0)),
                    'total_sold' => $sold,
                ];
            });

            // 6) Stock movements list:
            // If you have a StockMovement model/table, prefer it. Otherwise, reconstruct from order items (only sales).
            $movements = [];

                // fallback: recent sales mapped from order items (sales only)
                $movements = OrderItem::with(['product', 'order.user'])
                    ->join('orders', 'orders.id', '=', 'order_items.order_id')
                    ->whereBetween('orders.created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                    ->select('order_items.*','orders.invoice_number as order_no','orders.user_id as order_user_id','orders.created_at as order_created_at')
                    ->orderBy('orders.created_at', 'desc')
                    ->limit(500)
                    ->get()
                    ->map(function ($ri) {
                        return (object)[
                            'date' => (string) ($ri->order_created_at ?? $ri->created_at),
                            'product_name' => $ri->product?->name ?? null,
                            'type' => 'Sale',
                            'qty' => (int) $ri->quantity,
                            'before' => null,
                            'after' => null,
                            'order_no' => $ri->order_no ?? null,
                            'customer' => $ri->order?->user?->first_name ? ($ri->order->user->first_name . ' ' . ($ri->order->user->last_name ?? '')) : 'Guest'
                        ];
                    });


            // 7) Low stock & out of stock lists
            $lowStockItems = Product::where('stock_quantity', '>', 0)->where('stock_quantity', '<=', 10)->orderBy('stock_quantity')->get();
            $outOfStockItems = Product::where('stock_quantity', '<=', 0)->orderBy('name')->get();

            // totals
            $totalProducts = Product::count();
            $totalInventoryValue = Product::select(DB::raw('SUM(stock_quantity * COALESCE(price,0)) as value'))->value('value') ?? 0;

            return [
                'timestamp' => now()->toDateTimeString(),
                'products' => $stockLevels,
                'top_sellers' => $topSellers,
                'daily_sold' => $dailySold,
                'movements' => $movements,
                'low_stock_items' => $lowStockItems,
                'out_of_stock_items' => $outOfStockItems,
                'totalProducts' => $totalProducts,
                'totalInventoryValue' => $totalInventoryValue,
            ];
        });

        return response()->json($payload);
    }

    /**
     * Export current filtered view as CSV.
     */
    public function exportCsv(Request $request)
    {
        // reuse data builder (but not to double-cache) - simpler approach: call data() then transform
        $dataResp = $this->data($request);
        $data = $dataResp->getData(true);

        // Prepare CSV stream
        $filename = 'inventory_export_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($data) {
            $handle = fopen('php://output', 'w');
            // header row for products
            fputcsv($handle, ['Product ID','Product Name','SKU','Category','Unit','Stock Qty','Price','Stock Value','Total Sold']);

            foreach ($data['products'] as $p) {
                fputcsv($handle, [
                    $p['id'] ?? '',
                    $p['name'] ?? '',
                    $p['sku'] ?? '',
                    $p['category'] ?? '',
                    $p['unit'] ?? '',
                    $p['stock_quantity'] ?? 0,
                    $p['price'] ?? 0,
                    $p['stock_value'] ?? 0,
                    $p['total_sold'] ?? 0,
                ]);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }
}

/**
 * Helper: quick check if a database table has a column.
 * We keep it simple to avoid fatal errors when column absent.
 */
if (!function_exists('SchemaHasColumn')) {
    function SchemaHasColumn($table, $column)
    {
        try {
            return Schema::hasColumn($table, $column);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
