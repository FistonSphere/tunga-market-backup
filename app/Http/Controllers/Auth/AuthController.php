<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\User;
use App\Notifications\OtpRegistrationMail;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Logic to show the login form
        return view('frontend.auth.auth'); // Adjust the view name as necessary
    }
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $otp = rand(1000, 9999);
        Log::info("OTP generated: $otp");

        $pendingUser = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ];

        session(['pending_user' => $pendingUser]);
        Log::info('Pending user stored in session', ['email' => $request->email]);

        try {
            Mail::to($request->email)->send(new SendOtpMail((object) $pendingUser));
            Log::info("✅ OTP email successfully sent to {$request->email}");
        } catch (\Exception $e) {
            Log::error("❌ Failed to send OTP email: " . $e->getMessage());
            return response()->json(['error' => 'Failed to send OTP email.'], 500);
        }

        return response()->json(['message' => 'OTP sent.'], 200);
    }

    public function verifyOtp(Request $request)
    {
        $otp = $request->otp;
        $pendingUser = Session::get('pending_user');

        if (!$pendingUser) {
            return response()->json(['status' => 'error', 'message' => 'No pending registration.']);
        }

        if ($otp == $pendingUser['otp']) {
            // Create user in DB
            $user = User::create([
                'first_name' => $pendingUser['first_name'],
                'last_name' => $pendingUser['last_name'],
                'email' => $pendingUser['email'],
                'phone' => $pendingUser['phone'],
                'password' => bcrypt($pendingUser['password']),
            ]);

            Session::forget('pending_user');

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Incorrect OTP.']);
    }
}
