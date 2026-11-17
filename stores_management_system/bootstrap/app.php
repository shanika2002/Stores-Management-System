<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register custom route middleware aliases
        $middleware->alias([
            'admin.only' => \App\Http\Middleware\RestrictToAdmin::class,
            'manager' => \App\Http\Middleware\RestrictToManager::class,
            'stockkeeper' => \App\Http\Middleware\RestrictToStockKeeper::class,
            'view.only' => \App\Http\Middleware\RestrictToViewOnly::class,
            'technician' => \App\Http\Middleware\RestrictToTechnician::class,
            'management.assistance' => \App\Http\Middleware\RestrictToManagementAssistance::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();