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
    public function handle(Request $request, Closure $next, $role = null)
    {
        $user = $request->user();

        if (! $user) {
            // No autenticado
            return redirect()->route('login');
        }

        if ($user->rol !== $role) {  
            abort(403, 'No autorizado');
        }

        return $next($request);
    }
    protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    // ... otros que tengas ...
    
    // 🔥 AGREGA ESTA LÍNEA:
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];

}