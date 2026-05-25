<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GroqModerationService
{
    // analisi del testo per rilevamento contenuti offensivi
    public function isOffensive(string $text): bool
    {
        $apiKey = env('GROQ_API_KEY');

        // check presenza chiave ambiente e logging errore di configurazione
        if (empty($apiKey)) {
            Log::error('Groq API Key mancante nel file .env');
            return false; 
        }

        // chiamata http post verso groq con impostazione istruzioni di sistema
        $response = Http::withToken($apiKey)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant', //modello facilmente integrabile
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Sei un moderatore severo. Il testo dell\'utente è in ITALIANO. Se il testo contiene insulti, parolacce, odio o volgarità, rispondi ESATTAMENTE E SOLO con la parola "true". Se il testo è pulito e normale, rispondi ESATTAMENTE E SOLO con la parola "false". Non aggiungere nessuna punteggiatura o altra parola.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $text
                    ]
                ],
                'temperature' => 0,
                'max_tokens' => 5 
            ]);

        // lettura esito positivo e parsing della risposta booleana ricevuta
        if ($response->successful()) {
            $result = trim(strtolower($response->json('choices.0.message.content')));
            return str_contains($result, 'true');
        }

        Log::error('Errore chiamata Groq API: ' . $response->body());        
        return false;
    }
}