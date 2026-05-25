<?php

// questo controller serve a gestire la ricezione e il salvataggio nel database dei nuovi commenti scritti dagli utenti sotto un dibattito

namespace App\Http\Controllers;

use App\Models\Debate;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Debate $debate)
    {
        // controlliamo che il testo del commento esista non sia vuoto e sia lungo massimo mille caratteri
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // inseriamo il nuovo commento nel database collegandolo al dibattito giusto e prendendo l id dell utente loggato
        $comment = $debate->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(), 
        ]);

        // inviamo una risposta json con i dettagli del commento e l iniziale del nome per far aggiornare i dati a schermo al frontend
        return response()->json([
            'body' => $comment->body,
            'user_name' => auth()->user()->name,
            'initials' => strtoupper(substr(auth()->user()->name, 0, 1)),
            'count' => $debate->comments()->count(), 
        ]);
    }
}