<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserSessionController extends Controller
{
    public function index()
    {
        $sessions = UserSession::where('user_id', Auth::id())
            ->orderByDesc('last_active_at')
            ->get();

        return response()->json($sessions);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $agent = $request->header('User-Agent');
        $device = $this->getDevice($agent);
        $browser = $this->getBrowser($agent);
        $platform = $this->getPlatform($agent);

        // Mark all as not current before saving new session
        UserSession::where('user_id', $user->id)->update(['is_current' => false]);

        UserSession::updateOrCreate(
            ['session_id' => session()->getId()],
            [
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'device' => $device,
                'browser' => $browser,
                'platform' => $platform,
                'location' => $this->getLocation($request->ip()),
                'last_active_at' => now(),
                'is_current' => true,
            ]
        );

        return response()->json(['message' => 'Session stored successfully']);
    }

    public function destroy($id)
    {
        $session = UserSession::where('user_id', Auth::id())->findOrFail($id);
        $session->delete();
        return response()->json(['message' => 'Session revoked successfully']);
    }

    public function destroyAll()
    {
        UserSession::where('user_id', Auth::id())
            ->where('session_id', '!=', session()->getId())
            ->delete();

        return response()->json(['message' => 'All other sessions revoked']);
    }

    private function getDevice($agent)
    {
        if (str_contains($agent, 'Mobile')) return 'Mobile';
        elseif (str_contains($agent, 'Tablet')) return 'Tablet';
        return 'Desktop';
    }

    private function getBrowser($agent)
    {
        return preg_match('/Chrome/i', $agent) ? 'Chrome' :
               (preg_match('/Firefox/i', $agent) ? 'Firefox' :
               (preg_match('/Safari/i', $agent) ? 'Safari' : 'Unknown'));
    }

    private function getPlatform($agent)
    {
        return preg_match('/Windows/i', $agent) ? 'Windows' :
               (preg_match('/Mac/i', $agent) ? 'Mac' :
               (preg_match('/Linux/i', $agent) ? 'Linux' : 'Unknown'));
    }

    private function getLocation($ip)
    {
        // For now, simple placeholder — can integrate IP geolocation API later
        return 'Unknown';
    }
}
