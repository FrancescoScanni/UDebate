<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureModerator
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isModerator()) {
            abort(403, 'Accesso riservato ai moderatori.');
        }
        return $next($request);
    }
}