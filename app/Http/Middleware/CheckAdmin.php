<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y es admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Si no es admin, redirigir al dashboard
        return redirect()->route('dashboard')
                         ->with('error', 'No tienes permisos para acceder a esta área.');
    }
}