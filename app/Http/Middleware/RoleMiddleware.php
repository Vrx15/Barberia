<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Si no está autenticado o el rol no coincide, denegar acceso
        if (!Auth::check() || Auth::user()->rol !== $role) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return $next($request);
    }
}

