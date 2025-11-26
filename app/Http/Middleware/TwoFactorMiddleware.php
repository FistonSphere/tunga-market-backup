<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // If user has 2FA enabled and hasn't passed verification this session
        if ($user && $user->two_factor_enabled && !session('two_factor_passed', false)) {
            // Allow the verification route itself or logout route to avoid loop
            if ($request->is('2fa*') || $request->is('logout') || $request->is('account/admin/*')) {
                return $next($request);
            }
            return redirect()->route('2fa.verify.show');
        }

        return $next($request);
    }
}
