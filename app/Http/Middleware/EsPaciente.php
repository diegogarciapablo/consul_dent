<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EsPaciente
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): \Symfony\Component\HttpFoundation\Response
    {
        $user = $request->user();

        if (! $user || $user->role !== 'paciente') {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
