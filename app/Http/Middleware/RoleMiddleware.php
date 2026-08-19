<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {

        $usuario = $request->session()->get('usuario');

        if (!$usuario) {
            return redirect()
                ->route('login')
                ->with('error', 'Debes iniciar sesión.');
        }

        if (!in_array($usuario['rol'], $roles, true)) {
            abort(403, 'No tienes permiso para acceder.');
        }

        return $next($request);
    }
}