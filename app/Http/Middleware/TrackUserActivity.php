<?php

namespace App\Http\Middleware;

use App\Models\UserActivityLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;

class TrackUserActivity
{
   public function handle(Request $request, Closure $next)
    {
        if (session('cookies_accepted', false)) {
            $agent = new Agent();

            UserActivityLog::create([
                'user_id' => auth()->id(),
                'ip_address' => $request->ip(),
                'device' => $agent->device(),
                'browser' => $agent->browser(),
                'platform' => $agent->platform(),
                'location' => $this->getLocationFromIP($request->ip()),
                'page_visited' => $request->path(),
            ]);
        }

        return $next($request);
    }

    private function getLocationFromIP($ip)
    {
        try {
            $response = @file_get_contents("https://ipapi.co/{$ip}/json/");
            if ($response) {
                $data = json_decode($response);
                return $data->city . ', ' . $data->country_name;
            }
        } catch (\Exception $e) {
            return 'Unknown';
        }
        return 'Unknown';
    }
}
