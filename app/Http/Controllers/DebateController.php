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
            // 1. Valida sia il titolo che il messaggio
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            // 2. Crea il dibattito (ora prenderà anche il titolo grazie al $fillable)
            $request->user()->debates()->create($validated);

            return redirect()->route('dashboard');
        }

    public function update(Request $request, Debate $debate)
    {
        // 1. Controllo di sicurezza: l'utente è il proprietario?
        if ($debate->user_id !== auth()->id()) {
            abort(403, 'Azione non autorizzata.');
        }
        // 2. Validazione
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);
        // 3. Aggiornamento
        $debate->update([
            'title' => $request->title,
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