<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|null  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $rol = null)
    {
        $user = $request->user();

        if (! $user) {
            // No autenticado
            return redirect()->route('login');
        }

        // Si usas spatie/permission
        if (method_exists($user, 'hasRole')) {
            if (! $user->hasRole($rol)) {
                abort(403, 'No autorizado');
            }
        } else {
            // Ejemplo simple: suponiendo que tienes un campo `role` en la tabla users
            if ($user->rol !== $rol) {
                abort(403, 'No autorizado');
            }
        }

        return $next($request);
    }
}
