<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        // Logic to send password reset link to the user's email

        return view('frontend.auth.reset');
    }
}
