<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8|confirmed',
        ]);

        $otp = rand(1000, 9999);

        // Save to session
        Session::put('pending_user', [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        Session::put('otp', $otp);

        // Simulated Email Sending (real mail setup needed)
        Mail::raw("Your verification code is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Email Verification Code');
        });

        return response()->json(['success' => true]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        if ((string) $request->otp !== (string) Session::get('otp')) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }

        $userData = Session::get('pending_user');
        $user = User::create([
            'first_name' => $userData['first_name'],
            'last_name'  => $userData['last_name'],
            'email'      => $userData['email'],
            'password'   => $userData['password'],
        ]);

        // Auto login user (optional)
        auth()->login($user);

        // Clear session
        Session::forget(['otp', 'pending_user']);

        return response()->json(['success' => true]);
    }
}
