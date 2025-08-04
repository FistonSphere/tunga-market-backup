<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\User;
use App\Notifications\OtpRegistrationMail;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
            'otp' => 'required|digits:4', // ensure this is 4 digits
        ]);

        $pendingUser = session('pending_user');

        if (!$pendingUser) {
            return response()->json(['error' => 'No registration attempt found.'], 422);
        }

        if ($request->otp != $pendingUser['otp']) {
            return response()->json(['error' => 'Invalid OTP.'], 422);
        }

        if (now()->gt($pendingUser['otp_expires_at'])) {
            return response()->json(['error' => 'OTP expired.'], 422);
        }

        // Create user
        $user = User::create([
            'first_name' => $pendingUser['first_name'],
            'last_name' => $pendingUser['last_name'],
            'email' => $pendingUser['email'],
            'password' => $pendingUser['password'],
        ]);

        session()->forget('pending_user');
        auth()->login($user);

        return response()->json(['message' => 'Account created and verified successfully, now swipe to login.', 'redirect' => route('login')]);
    }

    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Attempt login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->has('remember'))) {

            $request->session()->regenerate();

            return redirect()->intended()->with('success', 'Login successful!');
        }

        return back()->withErrors(['password' => 'The provided credentials are incorrect.'])->withInput();
    }
    public function logout(Request $request)
    {
        auth()->logout();
        Session::flush();
        return redirect()->back()->with('message', 'You have been logged out successfully.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.auth.user-profile', compact('user'));
    }
}
