<?php

namespace App\Http\Controllers;

use App\Models\Debate;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Debate $debate)
    {
        // 1. Controlliamo che il testo del commento esista e non sia vuoto
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // 2. Creiamo il commento (lo salviamo in una variabile per recuperare i dati subito dopo)
        $comment = $debate->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(), 
        ]);

        // 3. IL FIX: Invece di ricaricare la pagina, mandiamo a Alpine i dati del commento appena creato
        return response()->json([
            'body' => $comment->body,
            'user_name' => auth()->user()->name,
            'initials' => strtoupper(substr(auth()->user()->name, 0, 1)),
            'count' => $debate->comments()->count(), // Serve a Alpine per aggiornare il numerino dei commenti
        ]);
    }
}