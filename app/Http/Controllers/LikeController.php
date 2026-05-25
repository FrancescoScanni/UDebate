<?php

// gestione dei mi piace sui dibattiti con logica di toggle

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debate;

class LikeController extends Controller
{
    // inversione stato del mi piace
    public function toggle(Debate $debate)
    {
        // recupero utente autenticato
        $user = auth()->user();
        // verifica esistenza mi piace precedente
        $hasLiked = $debate->isLikedBy($user);

        // rimozione o inserimento record mi piace
        if ($hasLiked) {
            // rimozione mi piace dal database
            $debate->likes()->where('user_id', $user->id)->delete();
            $isNowLiked = false;

        } else {
            // creazione nuovo mi piace nel database
            $debate->likes()->create([
                'user_id' => $user->id
            ]);
            $isNowLiked = true;
        }

        // risposta per richiesta asincrona frontend
        if (request()->wantsJson()) {
            // restituzione stato e contatore aggiornato
            return response()->json([
                'liked' => $isNowLiked, 
                'count' => $debate->likes()->count() 
            ]);
        }
        return back();
    }
}