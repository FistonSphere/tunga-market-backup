<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $adminId = Auth::id();
        $notifications = Notification::where('admin_id', $adminId)
            ->latest()
            ->paginate(15);

        $unreadCount = Notification::where('admin_id', $adminId)
            ->where('is_read', false)
            ->count();

         // Analytics data (example model helpers)
    $stats = [
        'weekly' => Notification::countByPeriod('7 days'),
        'monthly' => Notification::countByPeriod('28 days'),
        'yearly' => Notification::countByPeriod('1 year'),
    ];

    $growth = Notification::growthComparison();

    // Optional: group by day for chart
    $chartData = Notification::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get();
        return view('admin.notifications.index', compact('notifications', 'unreadCount', 'stats', 'growth', 'chartData'));
    }

    /**
     * Display a single notification
     */
    public function show($id)
    {
        $adminId = Auth::id();
        $notification = Notification::where('admin_id', $adminId)->findOrFail($id);

        // Mark as read if unread
        if (!$notification->is_read) {
            $notification->update(['is_read' => true]);
        }

        Log::info("🔔 Admin {$adminId} viewed notification #{$id}");

        // Optionally redirect to related page if exists in data
        if (isset($notification->data['redirect_url'])) {
            return redirect($notification->data['redirect_url']);
        }

        return view('admin.notifications.show', compact('notification'));
    }

    /**
     * Mark all as read
     */
    public function markAllAsRead(Request $request)
{
    $adminId = Auth::id();

    // Update all unread notifications for this admin
    $updated = Notification::where('admin_id', $adminId)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    Log::info("✅ Admin {$adminId} marked {$updated} notifications as read.");

    // If AJAX request, return JSON
    if ($request->ajax()) {
        return response()->json(['status' => 'success', 'message' => 'All notifications marked as read.']);
    }

    // Otherwise redirect with flash message
    return redirect()->back()->with('success', 'All notifications marked as read.');
}

public function sendPeriodicReport($period = '7_days')
{
    $adminUsers = User::where('is_admin', 'yes')->get();

    // Define date ranges
    $now = Carbon::now();
    $startDate = match ($period) {
        '7_days'  => $now->copy()->subDays(7),
        '28_days' => $now->copy()->subDays(28),
        'year'    => $now->copy()->subYear(),
        default   => $now->copy()->subDays(7),
    };

    // Get notifications in this period
    $notifications = Notification::where('created_at', '>=', $startDate)->get();

    // Compute analytics
    $total = $notifications->count();
    $byType = $notifications->groupBy('type')->map->count();

    // Compare to previous period for growth %
    $previousCount = Notification::whereBetween('created_at', [
        $startDate->copy()->subDays($startDate->diffInDays($now)),
        $startDate
    ])->count();

    $growth = $previousCount > 0 ? (($total - $previousCount) / $previousCount) * 100 : 0;

    $reportData = [
        'period' => $period,
        'total' => $total,
        'byType' => $byType,
        'growth' => round($growth, 2),
        'start' => $startDate->format('M d, Y'),
        'end' => $now->format('M d, Y'),
    ];

    foreach ($adminUsers as $admin) {
        Mail::send('emails.notification_report', [
            'admin' => $admin,
            'report' => $reportData,
            'title' => "📊 Platform Activity Report — {$reportData['period']}",
        ], function ($message) use ($admin, $reportData) {
            $message->to($admin->email, $admin->name)
                ->subject("Platform Report ({$reportData['period']}) - Tunga Market");
        });
    }

    Log::info("✅ Notification report email sent to admins for period: {$period}");
    return response()->json(['status' => 'success', 'message' => "Report sent for {$period}."]);
}

}
