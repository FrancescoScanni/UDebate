<?php

// pannello di controllo moderatore e gestione del topic del giorno

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Debate;
use App\Models\DailyTopic;
use App\Services\GroqModerationService;

class ModeratorController extends Controller
{
    protected $moderator;
    
    // injection servizio di controllo ai
    public function __construct(GroqModerationService $moderator)
    {
        $this->moderator = $moderator;
    }

    // conteggio record e lettura ultimo topic attivo
    public function index()
    {
        // statistiche generali piattaforma
        $usersCount = User::count();
        $debatesCount = Debate::count();
        
        // recupero del tema odierno
        $currentTopic = DailyTopic::latest()->first();

        return view('moderator.dashboard', compact('usersCount', 'debatesCount', 'currentTopic'));
    }

    // validazione check ai e persistenza del nuovo topic
    public function updateTopic(Request $request)
    {
        // controllo stringa in entrata
        $request->validate([
            'topic' => 'required|string|max:255'
        ]);

        // verifica ai anti insulti sul topic
        if ($this->moderator->isOffensive($request->topic)) {
            return back()->withErrors(['topic' => 'Il topic inserito è inappropriato.']);
        }

        // salvataggio o sovrascrittura record con id fisso
        DailyTopic::updateOrCreate(
            ['id' => 1], 
            ['topic' => $request->topic]
        );

        return back()->with('success', 'Topic del giorno aggiornato correttamente!');
    }
}