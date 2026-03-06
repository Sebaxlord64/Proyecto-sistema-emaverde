<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, $rol)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->rol != $rol) {
            return redirect('/')->with('error', 'No tienes acceso a esta sección.');
        }

        return $next($request);
    }
}
