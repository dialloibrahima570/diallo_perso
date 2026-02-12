<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventRequestsDuringMaintenance
{
    public function handle(Request $request, Closure $next): Response
    {
        if (file_exists(storage_path('framework/down'))) {
            abort(503);
        }

        return $next($request);
    }
}
