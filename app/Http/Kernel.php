<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Application HTTP Kernel
 *
 * This Kernel registers global middleware, middleware groups (web/api),
 * and route middleware (including custom middlewares like 'is_admin').
 *
 * If you add custom middleware classes, register them in the $routeMiddleware
 * array below and reference them in routes/web.php or controller constructors.
 */
class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     *
     * These middleware run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Trust proxies (if using load balancers / proxies)
        // \App\Http\Middleware\TrustProxies::class,

        // Handles CORS (cross-origin resource sharing) preflight requests
        // \Fruitcake\Cors\HandleCors::class,

        // Prevent requests during maintenance mode
        \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,

        // Validate the post size and trim strings
        \Illuminate\Http\Middleware\ValidatePostSize::class,
        // \App\Http\Middleware\TrimStrings::class,

        // Convert empty strings to null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Encrypt cookies & add queued cookies to response
            // \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

            // Start session
            \Illuminate\Session\Middleware\StartSession::class,

            // Optional: authenticate session for stateful SPA (uncomment if using)
            // \Illuminate\Session\Middleware\AuthenticateSession::class,

            // Share errors from session to views
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // CSRF protection
            // \App\Http\Middleware\VerifyCsrfToken::class,

            // Substitutes bindings (route-model binding)
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // If using API tokens or sanctum, add relevant middleware here
            // 'throttle:api' is typical
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Route middleware.
     *
     * These middleware may be assigned to routes or used within controllers.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        // Authentication / Authorization
        // 'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can'  => \Illuminate\Auth\Middleware\Authorize::class,
        // 'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        // Throttle & cache
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'signed'   => \Illuminate\Routing\Middleware\ValidateSignature::class,

        // Custom application middleware
        'is_admin' => \App\Http\Middleware\IsAdmin::class,         // ensures user is admin (is_admin = 'yes')
        // 'two_factor' => \App\Http\Middleware\EnsureTwoFactor::class ?? \App\Http\Middleware\EnsureTwoFactor::class, // optional 2FA middleware if you implement it

        // Example placeholders (uncomment/register actual classes if you add them)
        // 'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        // 'role' => \App\Http\Middleware\CheckUserRole::class,
    ];
}
