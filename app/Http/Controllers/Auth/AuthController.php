<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Logic to show the login form
        return view('frontend.auth.auth'); // Adjust the view name as necessary
    }

    public function initiate(Request $request)
    {
        // Honeypot (anti-bot field)
        if ($request->filled('company')) {
            return response()->json(['success' => false, 'message' => 'Bot detected.']);
        }

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8|confirmed',
        ]);

        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        Session::put('pending_user', [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'otp'        => $otp,
            'otp_expires_at' => $expiresAt,
        ]);

        // Send email using Laravel Notification with a custom design
        $user = new User(['email' => $request->email]); // Temp instance
        $user->notify(new SendOtpNotification($otp, $request->first_name));

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to your email',
        ]);
    }

    public function resendOtp(Request $request)
    {
        $data = Session::get('pending_user');
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please register again.']);
        }

        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        $data['otp'] = $otp;
        $data['otp_expires_at'] = $expiresAt;
        Session::put('pending_user', $data);

        $user = new User(['email' => $data['email']]);
        $user->notify(new SendOtpNotification($otp, $data['first_name']));

        return response()->json(['success' => true, 'message' => 'OTP resent successfully']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $data = Session::get('pending_user');

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Session expired.']);
        }

        if (now()->gt(Carbon::parse($data['otp_expires_at']))) {
            Session::forget('pending_user');
            return response()->json(['success' => false, 'message' => 'OTP expired. Please try again.']);
        }

        if ((string) $request->otp !== (string) $data['otp']) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => $data['password'],
        ]);

        auth()->login($user);

        Session::forget('pending_user');

        return response()->json(['success' => true, 'message' => 'Account verified and created.']);
    }
}
