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
        Log::info('Register method triggered');

        if ($request->filled('company')) {
            Log::warning('Bot honeypot triggered.');
            return response()->json(['success' => false, 'message' => 'Bot detected.'], 422);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray());
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
        }

        $otp = rand(100000, 999999);
        $expiresAt = now()->addHour();

        Log::info("OTP generated: $otp");

        Session::put('pending_user', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => $expiresAt,
        ]);

        Log::info('Pending user stored in session', ['email' => $request->email]);

        try {
            $tempUser = new User(['email' => $request->email]);
            $tempUser->notify(new SendOtpNotification($otp, $request->first_name));
            Log::info("✅ OTP email successfully sent to {$request->email}");
        } catch (\Exception $e) {
            Log::error("❌ Failed to send OTP email: " . $e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'OTP sent to your email']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $data = Session::get('pending_user');

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please try again.']);
        }

        if (now()->gt(Carbon::parse($data['otp_expires_at']))) {
            Session::forget('pending_user');
            return response()->json(['success' => false, 'message' => 'OTP expired. Please register again.']);
        }

        if ((string) $request->otp !== (string) $data['otp']) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }

        // Save new verified user
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        auth()->login($user);

        Session::forget('pending_user');

        return response()->json(['success' => true, 'message' => 'Account verified and created.']);
    }

    public function resendOtp(Request $request)
    {
        $data = Session::get('pending_user');

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please start over.']);
        }

        $otp = rand(100000, 999999);
        $expiresAt = now()->addHour();

        $data['otp'] = $otp;
        $data['otp_expires_at'] = $expiresAt;
        Session::put('pending_user', $data);

        $user = new User(['email' => $data['email']]);
        $user->notify(new SendOtpNotification($otp, $data['first_name']));

        return response()->json(['success' => true, 'message' => 'OTP resent successfully.']);
    }
}
