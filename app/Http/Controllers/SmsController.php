<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    
   public function create()
    {
        return view('frontend.sms');
    }

     public function send(Request $request)
    {
        // 1. Validate the form data
        $request->validate([
            'recipient' => 'required|string|min:9',
            'message' => 'required|string|max:160',
        ]);

        // 2. Prepare the API request data
        $apiToken = config('services.mista.api_token');
        $senderId = config('services.mista.sender_id');

        try {
            // 3. Send the HTTP POST request to Mista.io API
            $response = Http::withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $apiToken,
            ])->post('https://api.mista.io/sms', [
                'recipient' => $request->recipient,
                'sender_id' => $senderId,
                'message' => $request->message,
                'type' => 'plain',
            ]);

            // 4. Handle the API response
            if ($response->successful()) {
                return back()->with('success', 'SMS sent successfully! Response: ' . $response->body());
            } else {
                return back()->with('error', 'Failed to send SMS. Error: ' . $response->body());
            }

        } catch (Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
