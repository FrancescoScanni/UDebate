<?php
// middleware di protezione rotte riservate ai soli moderatori

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureModerator
{
    // intercettazione richiesta e controllo privilegi account
    public function handle(Request $request, Closure $next)
    {
        // blocco accesso se utente ospite o senza ruolo adatto
        if (!auth()->check() || !auth()->user()->isModerator()) {
            // interruzione ed emissione errore autorizzazione
            abort(403, 'Accesso riservato ai moderatori.');
        }

        // autorizzazione e passaggio al livello successivo
        return $next($request);
    }
}