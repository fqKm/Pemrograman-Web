<?php

namespace App\Http;

use Symfony\Component\HttpKernel\HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'permission' => \App\Http\Middleware\CheckPermission::class,
        // ... other middleware
    ];
}
