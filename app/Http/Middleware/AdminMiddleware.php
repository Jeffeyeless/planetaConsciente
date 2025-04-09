<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si el usuario está autenticado y es admin
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request); // Permite el acceso
        }

        // Redirige con un mensaje de error (opcionalmente, puedes abortar con 403)
        return redirect('/welcome')->with('error', 'Acceso restringido a administradores');
        
        // Opción alternativa (si prefieres mostrar error 403):
        // abort(403, 'Acceso no autorizado');
    }
}