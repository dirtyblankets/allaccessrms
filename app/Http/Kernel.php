<?php

namespace AllAccessRMS\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \AllAccessRMS\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \AllAccessRMS\Http\Middleware\VerifyCsrfToken::class,
        
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \AllAccessRMS\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \AllAccessRMS\Http\Middleware\RedirectIfAuthenticated::class,
        'acl' => \Kodeine\Acl\Middleware\HasPermission::class,
        'event_payment' =>  \AllAccessRMS\Http\Middleware\AttendeeRegistrationPayment::class,
    ];
}
