<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debate;

class LikeController extends Controller
{
    public function toggle(Debate $debate)
    {
        $user = auth()->user();
        
        // Controlliamo se l'utente ha già messo like usando il metodo che hai nel modello Debate
        $hasLiked = $debate->isLikedBy($user);

        if ($hasLiked) {
            // Se c'era già il like, lo eliminiamo
            $debate->likes()->where('user_id', $user->id)->delete();
            $isNowLiked = false;
        } else {
            // Se non c'era, lo creiamo
            $debate->likes()->create([
                'user_id' => $user->id
            ]);
            $isNowLiked = true;
        }

        // Se la richiesta arriva tramite AJAX (il nostro codice fetch di Alpine.js)
        if (request()->wantsJson()) {
            return response()->json([
                'liked' => $isNowLiked, // true o false
                'count' => $debate->likes()->count() // il nuovo totale dei like
            ]);
        }

        // Fallback di sicurezza: se per qualche motivo non è una richiesta JSON, ricarica la pagina
        return back();
    }
}
