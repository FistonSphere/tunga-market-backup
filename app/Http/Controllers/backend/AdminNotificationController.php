<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function markAllRead(Request $request)
    {
        $adminId = Auth::id();

        Notification::where('admin_id', $adminId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        Log::info("✅ All notifications marked as read by admin #{$adminId}");

        return response()->json(['status' => 'success']);
    }
}
