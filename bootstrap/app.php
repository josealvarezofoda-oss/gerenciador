<?php

use Illuminate\Foundation\Application;
/*
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
*/


return Application::configure(basePath: dirname(__DIR__))
    
    ->withMiddleware(function (\Illuminate\Foundation\Configuration\Middleware $middleware) {

        if (class_exists(\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class)) {
            $middleware->appendToGroup('api', [
                \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            ]);
        }

        // Aliases de middleware
        $aliases = [];

        // alias do middleware
        if (class_exists(\App\Http\Middleware\CheckTipoUsuario::class)) {
            $aliases['tipo'] = \App\Http\Middleware\CheckTipoUsuario::class;
            $aliases['checkTipoUsuario'] = \App\Http\Middleware\CheckTipoUsuario::class;
        }

        if (class_exists(\Laravel\Telescope\Http\Middleware\Authorize::class)) {
            $aliases['telescope'] = \Laravel\Telescope\Http\Middleware\Authorize::class;
        }

        if (! empty($aliases)) {
            $middleware->alias($aliases);
        }
    })

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withExceptions(function (\Illuminate\Foundation\Configuration\Exceptions $exceptions) {
        //
    })->create();
