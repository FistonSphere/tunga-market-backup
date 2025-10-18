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
    $email = session('reset_email');
    if (!$email) return redirect()->route('password.email')->withErrors(['email' => 'Session expired.']);
    return view('frontend.auth.reset', compact('email'));
}

public function resetPassword(Request $request)
{
    $request->validate([
        'new_password' => 'required|min:8|confirmed',
    ]);

    $email = session('reset_email');
    $user = User::where('email', $email)->first();
    if (!$user) return back()->withErrors(['email' => 'User not found.']);

    $user->password = Hash::make($request->new_password);
    $user->two_factor_code = null;
    $user->two_factor_expires_at = null;
    $user->save();

    session()->forget('reset_email');

    return redirect()->route('login')->with('success', 'Your password has been reset successfully.');
}

}
