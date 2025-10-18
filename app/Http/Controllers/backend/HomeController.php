<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\ContactRequest;
use App\Models\UserActivityLog;
use App\Models\ProductViewSnapshot;
class HomeController extends Controller
{
    public function dashboard()
    {
      return view('admin.index', [
        'totalUsers'         => User::count(),
        'totalProducts'      => Product::count(),
        'totalOrders'        => Order::count(),
        'totalRevenue'       => Order::sum('total'),
        'pendingCarts'       => Cart::count(), // or add filter if needed
        'contactRequests'    => ContactRequest::count(),
        'activityLogs'       => UserActivityLog::count(),
        'productViewsToday'  => ProductViewSnapshot::whereDate('created_at', now())->count(),
    ]);
    }
}
