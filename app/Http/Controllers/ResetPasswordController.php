<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('frontend.auth.reset');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = session('verified_user_email');
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Session expired.']);
        }

        $user = User::where('email', $email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget(['reset_email', 'verified_user_email']);
        return redirect()->route('login')->with('success', 'Password reset successfully! Please sign in.');
    }
}
