<?php

namespace App\Http\Controllers;

use App\Models\Debate;
use Illuminate\Http\Request;

class DebateController extends Controller
{
    // Mostra la dashboard con i dibattiti
    public function index()
    {
        // Prende tutti i dibattiti, dal più recente, con l'autore allegato
        $debates = Debate::with(['user', 'likes', 'comments.user'])->latest()->get();

        // Manda i dati alla vista 'dashboard' (che si trova in resources/views/dashboard.blade.php)
        return view('dashboard', compact('debates'));
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