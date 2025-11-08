<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:20|unique:users,phone',
            'password'   => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'is_admin'   => 'no',
            'role'       => 0,
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin account created successfully!');
    }

    public function login(Request $request)
    {

        
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found for this email.']);
        }

        if ($user->is_admin !== 'yes') {
            return back()->withErrors(['email' => 'Access denied. Only admins can log in here.']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        Auth::login($user);
        return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . $user->first_name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'You have been logged out.');
    }


    public function UserList(Request $request)
    {
         $query = User::query();

    if ($search = $request->get('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    if ($role = $request->get('role')) {
        $query->where('role', $role);
    }

    $users = $query->latest()->paginate(10);

    // If AJAX, return partial HTML only
    if ($request->ajax()) {
        return response()->json([
            'html' => view('admin.users.table_rows', compact('users'))->render(),
        ]);
    }
        return view('admin.users.index', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.list')->with('success', 'User deleted successfully.');
    }


     public function show(User $user)
    {
        // ✅ Basic details & eager loaded relationships
        $user->load(['orders.items', 'activityLogs', 'wishlistItems.product']);

        // ✅ Count and summaries
        $orderCount = $user->orders()->count();
        $wishlistCount = $user->wishlistItems()->count();
        $activityCount = $user->activityLogs()->count();

        // ✅ Calculate total spent (sum of all orders)
        $totalSpent = $user->orders()->sum('total');

        // ✅ Get most recent orders
        $recentOrders = $user->orders()
            ->with('items.product')
            ->latest()
            ->take(5)
            ->get();

        // ✅ Behavior analytics - most visited pages
        $pageVisits = $user->activityLogs()
            ->select('page_visited', DB::raw('COUNT(*) as total'))
            ->groupBy('page_visited')
            ->orderByDesc('total')
            ->take(8)
            ->get();

        // ✅ Behavior over time (last 30 days)
        $behaviorTrend = $user->activityLogs()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as visits'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.users.show', [
            'user' => $user,
            'orderCount' => $orderCount,
            'wishlistCount' => $wishlistCount,
            'activityCount' => $activityCount,
            'totalSpent' => $totalSpent,
            'recentOrders' => $recentOrders,
            'pageVisits' => $pageVisits,
            'behaviorTrend' => $behaviorTrend,
        ]);
    }
public function updateShipping(Request $request, $id)
{
    $address = ShippingAddress::findOrFail($id);
    $address->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'company' => $request->company,
        'address_line1' => $request->address_line1,
        'address_line2' => $request->address_line2,
        'city' => $request->city,
        'state' => $request->state,
        'postal_code' => $request->postal_code,
        'country' => $request->country,
        'phone' => $request->phone,
        'is_default' => $request->has('is_default'),
    ]);

    return response()->json(['success' => true]);
}


}
