<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use Jenssegers\Agent\Agent;

class UserActivityController extends Controller
{
  public function acceptCookies(Request $request)
{
    session(['cookies_accepted' => true]);

    return response()->json(['success' => true, 'message' => 'Cookies accepted'])
                     ->cookie('cookies_accepted', true, 60 * 24 * 365); // Optional: persistent browser cookie
}



    public function logActivity(Request $request)
    {
        if (!session('cookies_accepted')) {
            return response()->json(['success' => false, 'message' => 'Cookies not accepted'], 403);
        }

        $agent = new Agent();
        $user = auth()->user();

        UserActivityLog::create([
            'user_id' => $user ? $user->id : null,
            'ip_address' => $request->ip(),
            'device' => $agent->device(),
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
            'location' => $this->getLocationFromIP($request->ip()),
            'page_visited' => $request->input('page'),
        ]);

        return response()->json(['success' => true]);
    }

    private function getLocationFromIP($ip)
    {
        try {
            $response = @file_get_contents("https://ipapi.co/{$ip}/json/");
            if ($response) {
                $data = json_decode($response);
                return ($data->city ?? 'Unknown') . ', ' . ($data->country_name ?? 'Unknown');
            }
        } catch (\Exception $e) {
            return 'Unknown';
        }
        return 'Unknown';
    }
}
