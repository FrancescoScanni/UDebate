<?php

// gestione dibattiti e dashboard con moderazione ai

namespace App\Http\Controllers;

use App\Models\Debate;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Comment;
use App\Services\GroqModerationService; 
use App\Models\DailyTopic;

class DebateController extends Controller
{
    protected $moderator;

    // injection servizio moderazione
    public function __construct(GroqModerationService $moderator)
    {
        $this->moderator = $moderator;
    }

    // lettura dati statistiche e topic del giorno
    public function index()
    {
        $user = auth()->user();
        $dailyTopic = DailyTopic::latest()->first();
        $debates = Debate::with(['user', 'likes', 'comments.user'])->latest()->get();

        $debatesCount    = $user->debates()->count();
        $votesReceived   = Like::whereIn('debate_id', $user->debates()->pluck('id'))->count();
        $commentsReceived = Comment::whereIn('debate_id', $user->debates()->pluck('id'))->count();

        $myDebates       = $user->debates()->latest()->take(5)->get();
        $likesReceived   = Like::whereIn('debate_id', $user->debates()->pluck('id'))->with('debate')->latest()->take(5)->get();
        $commentsOnMine  = Comment::whereIn('debate_id', $user->debates()->pluck('id'))->with(['user', 'debate'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'debates', 'debatesCount', 'votesReceived', 'commentsReceived', 
            'myDebates', 'likesReceived', 'commentsOnMine', 'dailyTopic'
        ));
    }

    // validazione test analisi ai e persistenza dati
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $textToAnalyze = $validated['title'] . " " . $validated['message'];

        // check ai anti insulti
        if ($this->moderator->isOffensive($textToAnalyze)) {
            return back()->withErrors(['message' => 'Linguaggio inappropriato rilevato. Rivedi il testo.'])->withInput(); 
        }

        $request->user()->debates()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Dibattito pubblicato!');
    }

    // autorizzazione validazione check ai e update
    public function update(Request $request, Debate $debate)
    {
        if ($debate->user_id !== auth()->id()) abort(403);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);
        $textToAnalyze = $validated['title'] . " " . $validated['message'];

        // check ai su modifica
        if ($this->moderator->isOffensive($textToAnalyze)) {
            return back()->withErrors(['message' => 'Linguaggio inappropriato rilevato. Rivedi il testo.'])->withInput();
        }

        $debate->update($validated);
        return back()->with('success', 'Dibattito aggiornato!');
    }

    // autorizzazione e cancellazione record
    public function destroy(Debate $debate)
    {
        if ($debate->user_id !== auth()->id()) abort(403);
        $debate->delete();
        return back()->with('success', 'Dibattito eliminato.');
    }
}