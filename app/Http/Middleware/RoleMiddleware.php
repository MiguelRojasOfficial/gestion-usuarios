<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
        return $next($request);
    }
}
