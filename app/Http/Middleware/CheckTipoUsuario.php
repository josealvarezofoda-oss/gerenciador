<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTipoUsuario
{
    public function handle(Request $request, Closure $next, $tipo = null)
    {
        if ($tipo && (!Auth::check() || Auth::user()->tipo_usuario !== $tipo)) {
            abort(403, 'Acesso negado');
        }

        return $next($request);
    }
}
