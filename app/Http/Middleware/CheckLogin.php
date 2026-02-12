<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'admin est connecté
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
