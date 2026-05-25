<?php

namespace App\Http\Controllers;

use App\Models\Debate;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;

class DebateController extends Controller
{
    // Mostra la dashboard con i dibattiti e le statistiche dell'utente
    public function index()
    {
        $user = auth()->user();

        // Prende tutti i dibattiti, dal più recente, con l'autore allegato
        $debates = Debate::with(['user', 'likes', 'comments.user'])->latest()->get();

        // Conta i dibattiti aperti dall'utente loggato
        $debattiAperti = Debate::where('user_id', $user->id)->count();

        // Prende gli ID dei dibattiti dell'utente per le query successive
        $userDebateIds = Debate::where('user_id', $user->id)->pluck('id');

        // Conta i like ricevuti sui dibattiti dell'utente
        $likeRicevuti = Like::whereIn('debate_id', $userDebateIds)->count();

        // Conta i commenti ricevuti sui dibattiti dell'utente
        $risposte = Comment::whereIn('debate_id', $userDebateIds)->count();

        // Manda i dati alla vista 'dashboard'
        return view('dashboard', compact('debates', 'debattiAperti', 'likeRicevuti', 'risposte'));
    }

    // Salva un nuovo dibattito dal form
    public function store(Request $request)
    {
        // 1. Controlla che il campo non sia vuoto
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // 2. Salva il dibattito collegandolo all'utente loggato
        $request->user()->debates()->create($validated);

        // 3. Ricarica la pagina
        return back();
    }

    public function update(Request $request, Debate $debate)
    {
        // 1. Controllo di sicurezza: l'utente è il proprietario?
        if ($debate->user_id !== auth()->id()) {
            abort(403, 'Azione non autorizzata.');
        }

        // 2. Validazione
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // 3. Aggiornamento
        $debate->update([
            'message' => $request->message,
        ]);

        return back();
    }

    public function destroy(Debate $debate)
    {
        // 1. Controllo di sicurezza: l'utente è il proprietario?
        if ($debate->user_id !== auth()->id()) {
            abort(403, 'Azione non autorizzata.');
        }

        // 2. Eliminazione
        $debate->delete();

        return back();
    }
}