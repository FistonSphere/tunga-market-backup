<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('frontend.auth.forgot');
    }

    public function sendResetOTP(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No account found with that email address.']);
        }

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);
        $user->two_factor_code = $otp;
        $user->two_factor_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Send OTP email
        Mail::send('emails.reset-otp', ['user' => $user, 'otp' => $otp], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Password Reset Verification Code');
        });

        session(['reset_email' => $user->email]);
        return redirect()->route('password.otp')->with('success', 'We sent a verification code to your email.');
    }

    public function showOtpForm()
    {
        return view('frontend.auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        $user = User::where('email', session('reset_email'))->first();
        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'Session expired. Try again.']);
        }

        if ($user->two_factor_code != $request->otp || Carbon::now()->gt($user->two_factor_expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired code.']);
        }

        // Clear OTP
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->save();

        session(['verified_user_email' => $user->email]);

        return redirect()->route('password.reset')->with('success', 'Code verified! You can now reset your password.');
    }
}
