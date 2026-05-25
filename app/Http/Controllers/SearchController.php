<?php
//Re-ranker
namespace App\Http\Controllers;

use App\Models\Debate;
use App\Services\GroqService; // Assumiamo che tu abbia questo service
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $groq;

    public function __construct(GroqService $groq)
    {
        $this->groq = $groq;
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('search.index', ['results' => collect()]);
        }

        $candidates = Debate::where('title', 'like', "%{$query}%")
                            ->orWhere('message', 'like', "%{$query}%")
                            ->latest()
                            ->limit(15)
                            ->get();

        if ($candidates->isEmpty()) {
            return view('search.index', ['results' => collect(), 'query' => $query]);
        }

        $context = $candidates->map(fn($d) => "ID: {$d->id} | Titolo: {$d->title} | Contenuto: " . substr($d->message, 0, 100))->implode("\n");

        $prompt = "L'utente cerca: '{$query}'. Analizza questi post dal database:
        {$context}
        Restituisci solo gli ID dei post che corrispondono alla ricerca a livello di significato (es. 'Salutare' -> Ciao), separati da virgola (es: 1,5,10). Se nessuno è pertinente, scrivi 'nessuno'.";

        $aiResponse = $this->groq->askAI($prompt);
        $ids = explode(',', preg_replace('/[^0-9,]/', '', $aiResponse));


        $results = $candidates->filter(fn($d) => in_array($d->id, $ids))
                              ->sortBy(fn($d) => array_search($d->id, $ids));

        return view('search.index', ['results' => $results, 'query' => $query]);
    }
}