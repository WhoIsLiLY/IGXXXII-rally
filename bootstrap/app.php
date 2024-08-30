<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'post' => \App\Http\Middleware\EnsurePostRequest::class,
            'penpos' => \App\Http\Middleware\PenposMiddleware::class,
            'peserta' => \App\Http\Middleware\PesertaMiddleware::class,
            'guest_' => \App\Http\Middleware\GuestMiddleware::class,
        ]);

        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
