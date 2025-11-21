<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\AbandonedCartReminderMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\ContactRequest;
use App\Models\FlashDeal;
use App\Models\UserActivityLog;
use App\Models\ProductViewSnapshot;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeAdminController extends Controller
{
    public function dashboard()
    {

        $recentProducts = Product::latest()->take(5)->get();
        $sales = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
        ->where('status', 'Delivered')  // Only include delivered orders
        ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // Generate a full 7-day range to fill in missing days with 0
    $dateRange = collect();
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::today()->subDays($i);
        $dateRange->put($date->toDateString(), 0);
    }

    foreach ($sales as $sale) {
        $dateRange[$sale->date] = $sale->total;
    }

    $salesDates = $dateRange->keys()->map(fn($d) => Carbon::parse($d)->format('M d'))->toArray();
    $salesTotals = $dateRange->values()->toArray();

    $recentOrders = Order::with('user')->latest()->take(10)->get();
    $recentUsers = User::latest()->take(10)->get();
    $activeFlashDeals = FlashDeal::with('product')
        ->active()
        ->orderBy('end_time', 'asc')
        ->inRandomOrder(3)
        ->limit(3)
        ->get();
    $userLocations = User::select('country', DB::raw('count(*) as total'))
        ->whereNotNull('country')
        ->groupBy('country')
        ->get();

        $abandonedCarts = Cart::with('product', 'user')
        ->where('created_at', '<=', Carbon::now()->subDay())
        ->whereNotNull('user_id')
        ->get()
        ->groupBy('user_id');
        
      return view('admin.index', [
        'totalUsers'         => User::count(),
        'totalProducts'      => Product::count(),
        'totalOrders'        => Order::count(),
        'totalRevenue'       => Order::sum('total'),
        'pendingCarts'       => Cart::count(),
        'abbreviatedRevenue' =>abbreviateNumber(Order::sum('total')),
        'contactRequests'    => ContactRequest::count(),
        'activityLogs'       => UserActivityLog::count(),
        'productViewsToday'  => ProductViewSnapshot::whereDate('created_at', now())->count(),
        'recentProducts'     => $recentProducts,
        'salesDates'         => $salesDates,
        'salesTotals'        => $salesTotals,
        'recentOrders'       => $recentOrders,
        'recentUsers'        => $recentUsers,
        'activeFlashDeals'   => $activeFlashDeals,
        'userLocations'      => $userLocations,
        'abandonedCarts'     => $abandonedCarts
    ]);
    }



     public function sendReminder(User $user)
    {
        $items = Cart::with('product')->where('user_id', $user->id)->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'No items in cart to remind.');
        }

        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        Mail::to($user->email)->send(new AbandonedCartReminderMail($user, $items, $total));

        return back()->with('success', 'Reminder email sent to ' . $user->email);
    }
}
function abbreviateNumber($number, $precision = 1)
{
    if ($number < 900) {
        // 0 - 899
        $n_format = number_format($number, $precision);
        $suffix = '';
    } elseif ($number < 900000) {
        // 0.9k-850k
        $n_format = number_format($number / 1000, $precision);
        $suffix = 'K';
    } elseif ($number < 900000000) {
        // 0.9m-850m
        $n_format = number_format($number / 1000000, $precision);
        $suffix = 'M';
    } elseif ($number < 900000000000) {
        // 0.9b-850b
        $n_format = number_format($number / 1000000000, $precision);
        $suffix = 'B';
    } else {
        // 0.9t+
        $n_format = number_format($number / 1000000000000, $precision);
        $suffix = 'T';
    }

    // Remove unnecessary decimal zeroes (e.g., 1.0K → 1K)
    if ($precision > 0) {
        $dot_zero = '.' . str_repeat('0', $precision);
        $n_format = str_replace($dot_zero, '', $n_format);
    }

    return $n_format . $suffix;
}
