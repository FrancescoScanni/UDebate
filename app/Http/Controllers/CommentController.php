<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Debate $debate)
    {
        // 1. Verifichiamo che il commento non sia vuoto
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // 2. Salviamo il commento nel database collegato a questo dibattito
        $comment = $debate->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        // 3. Se la richiesta arriva dal nostro script AJAX
        if ($request->wantsJson()) {
            $user = auth()->user();
            
            // Restituiamo i dati che la pagina si aspetta per aggiornare l'interfaccia
            return response()->json([
                'body' => $comment->body,
                'count' => $debate->comments()->count(),
                'user_name' => $user->name,
                'initials' => strtoupper(substr($user->name, 0, 1)),
            ]);
        }

        // Fallback di sicurezza
        return back();
    }
}
