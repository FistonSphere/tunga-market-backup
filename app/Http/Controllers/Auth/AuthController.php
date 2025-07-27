<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Logic to show the login form
        return view('frontend.auth.auth'); // Adjust the view name as necessary
    }
}
