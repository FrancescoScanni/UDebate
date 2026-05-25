<?php

namespace App\Http\Controllers;

use App\Models\Debate;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Comment;

class DebateController extends Controller
{
    // Mostra la dashboard con i dibattiti
    public function index()
    {
        $user = auth()->user();
        $debates = Debate::with(['user', 'likes', 'comments.user'])->latest()->get();

        // ── Blocchi stats attuali ──────────────────────────────────────
        $debatesCount    = $user->debates()->count();
        $votesReceived   = Like::whereIn('debate_id', $user->debates()->pluck('id'))->count();
        $commentsReceived = Comment::whereIn('debate_id', $user->debates()->pluck('id'))->count();
        // "Reputazione" = voti + commenti ricevuti (formula a piacere)
        $reputation      = $votesReceived + $commentsReceived;

        // ── 3 nuovi blocchi sidebar ────────────────────────────────────
        $myDebates       = $user->debates()->latest()->take(5)->get();          // Dibattiti aperti da me
        $likesReceived   = Like::whereIn('debate_id', $user->debates()->pluck('id'))
                            ->with('debate')->latest()->take(5)->get();      // Like ricevuti
        $commentsOnMine  = Comment::whereIn('debate_id', $user->debates()->pluck('id'))
                                ->with(['user', 'debate'])->latest()->take(5)->get(); // Commenti ricevuti

        return view('dashboard', compact(
            'debates',
            'debatesCount', 'votesReceived', 'commentsReceived', 'reputation',
            'myDebates', 'likesReceived', 'commentsOnMine'
        ));
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