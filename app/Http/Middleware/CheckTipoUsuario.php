<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTipoUsuario
{
    public function handle(Request $request, Closure $next, $tipo)
    {
        if (!auth()->check() || auth()->user()->tipo_usuario !== $tipo) {
            abort(403, 'Acesso negado');
        }

        return $next($request);
    }
}
