<x-app-layout>
<div class="min-h-screen bg-[#0a0a0f] text-white pt-16" style="font-family:'DM Sans',sans-serif;">

    {{-- Glow blobs --}}
    <div class="fixed pointer-events-none inset-0 overflow-hidden z-0">
        <div class="absolute -top-60 -left-40 w-[500px] h-[500px] bg-[#e8ff47]/5 rounded-full blur-[140px]"></div>
        <div class="absolute top-1/2 -right-60 w-[400px] h-[400px] bg-[#3d8bff]/5 rounded-full blur-[140px]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Header --}}
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-2 h-2 rounded-full bg-[#e8ff47] animate-pulse"></div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#e8ff47]">Arena attiva</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-bold tracking-normal leading-tight mb-3" style="font-family: 'Inter', sans-serif;">
                Ciao, {{ auth()->user()->name }}<br>
                <span class="text-zinc-500 sm:text-5xl font-normal">Cosa dibatti oggi?</span>
            </h1>
        </div>
        
        {{-- Stats row --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-10">
            @php
            $stats = [
                ['label' => 'Dibattiti aperti', 'value' => $debatesCount,     'icon' => '💬', 'color' => 'e8ff47'],
                ['label' => 'Voti ricevuti',    'value' => $votesReceived,    'icon' => '🗳️', 'color' => '3d8bff'],
                ['label' => 'Risposte',         'value' => $commentsReceived, 'icon' => '↩️', 'color' => 'c084fc'],
            ];
            @endphp

            @foreach($stats as $s)
            <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-4 sm:p-5 hover:border-zinc-700 transition-colors">
                <div class="text-2xl mb-2">{{ $s['icon'] }}</div>
                <div class="text-2xl font-black" style="font-family:'Syne',sans-serif;color:#{{ $s['color'] }}">{{ $s['value'] }}</div>
                <div class="text-xs text-zinc-500 mt-0.5 font-medium">{{ $s['label'] }}</div>
            </div>
            @endforeach

            {{-- Quarta cella: pulsante reload --}}
            <button onclick="window.location.reload()" class="rounded-2xl p-4 sm:p-5 hover:bg-[#e8ff47]/5 transition-colors group flex flex-col items-center justify-center gap-2">
                <svg class="w-8 h-8 text-[#e8ff47] group-hover:rotate-180 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                </svg>
                <span class="text-sm font-black uppercase tracking-wider text-[#e8ff47]" style="font-family:'Syne',sans-serif;">Reload</span>
            </button>
        </div>

        {{-- Main grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Feed area --}}
            <div class="lg:col-span-2 space-y-4" x-data="{ mostraForm: false }">
                
                <div class="flex items-center justify-between mb-1">
                    <h2 class="font-black text-lg" style="font-family:'Syne',sans-serif;">Feed</h2>
                    <div class="flex gap-2">
                        <form action="{{ route('dashboard') }}" method="GET" class="flex-1 mx-4">
                            <input 
                                type="text" 
                                name="q" 
                                value="{{ request()->query('q') }}" 
                                placeholder="Cerca dibattito..." 
                                class="w-full bg-[#111118] border border-[#1e1e2e] rounded-lg py-1.5 px-4 text-xs text-white focus:ring-0 focus:border-[#e8ff47] transition-colors"
                            >
                        </form>
                        <button class="px-3 py-1.5 rounded-lg bg-[#e8ff47]/10 text-[#e8ff47] text-xs font-bold border border-[#e8ff47]/20">Tutti</button>
                    </div>
                </div>

                {{-- New debate CTA --}}
                <div x-show="!mostraForm" 
                     @click="mostraForm = true"
                     class="bg-[#111118] border border-dashed border-[#e8ff47]/25 rounded-2xl p-5 flex items-center gap-4 hover:border-[#e8ff47]/50 transition-colors cursor-pointer group">
                    <div class="w-10 h-10 rounded-xl bg-[#e8ff47]/10 flex items-center justify-center text-[#e8ff47] group-hover:bg-[#e8ff47]/20 transition-colors flex-shrink-0">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-zinc-300 group-hover:text-white transition-colors">Apri un nuovo dibattito</div>
                        <div class="text-xs text-zinc-600">Lancia la tua tesi e sfida la community</div>
                    </div>
                </div>

                {{-- FORM DI INSERIMENTO --}}
                <div x-show="mostraForm" x-cloak class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-5 mb-4">
                    <form method="POST" action="{{ route('debates.store') }}">
                        @csrf
                        
                        {{-- Input per il Titolo --}}
                        <div class="mb-3">
                            <input 
                                type="text" 
                                name="title" 
                                value="{{ old('title') }}"
                                class="w-full bg-[#0a0a0f] text-white border border-[#1e1e2e] rounded-xl p-4 focus:ring-0 focus:border-[#e8ff47] transition-colors placeholder-zinc-600 font-bold text-lg"
                                placeholder="Dai un titolo di forte impatto al tuo dibattito..."
                                required
                            >
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Textarea per il Messaggio --}}
                        <textarea 
                            name="message" 
                            rows="4" 
                            class="w-full bg-[#0a0a0f] text-white border border-[#1e1e2e] rounded-xl p-4 focus:ring-0 focus:border-[#e8ff47] transition-colors resize-none placeholder-zinc-600"
                            placeholder="Scrivi qui la tua tesi. Sii chiaro e diretto..."
                            required
                        ></textarea>
                        
                        @error('message')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror

                        <div class="flex justify-end mt-4 gap-3">
                            <button type="button" @click="mostraForm = false" class="px-5 py-2.5 rounded-xl text-zinc-400 text-sm font-bold hover:text-white transition-colors">
                                Annulla
                            </button>
                            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#e8ff47] text-black text-sm font-extrabold hover:bg-[#d4eb30] transition-colors">
                                Pubblica
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Logica del Feed --}}
                <div>
                    @if ($debates->isEmpty())
                        {{-- Empty state --}}
                        <div x-show="!mostraForm" class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-12 text-center">
                            <div class="text-5xl mb-4">⚖️</div>
                            <h3 class="font-black text-lg mb-2" style="font-family:'Syne',sans-serif;">Il feed è vuoto</h3>
                            <p class="text-zinc-500 text-sm max-w-xs mx-auto leading-relaxed">
                                Non ci sono ancora dibattiti. Sii il primo ad aprire una discussione e far partire il confronto.
                            </p>
                            <button @click="mostraForm = true" class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#e8ff47] text-black text-sm font-extrabold hover:bg-[#d4eb30] transition-colors">
                                Inizia tu
                                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                </svg>
                            </button>
                        </div>
                    @else
                        {{-- Feed Pieno --}}
                        <div class="space-y-4">
                            @foreach ($debates as $debate)
                            
                            {{-- Modulo Alpine per singolo dibattito --}}
                            <div x-data="{ 
                                inModifica: false, 
                                mostraCommenti: false,
                                liked: {{ $debate->isLikedBy(auth()->user()) ? 'true' : 'false' }},
                                likesCount: {{ $debate->likes->count() }},
                                commentsCount: {{ $debate->comments->count() }},
                                nuovoCommento: '',
                                commentiAggiunti: [],

                                toggleLike() {
                                    fetch('{{ route('likes.toggle', $debate) }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json'
                                        }
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        this.liked = data.liked;
                                        this.likesCount = data.count;
                                    });
                                },

                                inviaCommento() {
                                    if(this.nuovoCommento.trim() === '') return;

                                    fetch('{{ route('comments.store', $debate) }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({ body: this.nuovoCommento })
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        this.commentiAggiunti.push(data); 
                                        this.nuovoCommento = ''; 
                                        this.commentsCount = data.count; 
                                    });
                                }
                            }" class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-5 hover:border-zinc-700 transition-colors">
                                
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-[#3d8bff]/15 flex items-center justify-center text-[#3d8bff] font-bold text-xs">
                                            {{ strtoupper(substr($debate->user->name, 0, 1)) }}
                                        </div>
                                        <span class="font-bold text-white text-sm">{{ $debate->user->name }}</span>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        <span class="text-zinc-500 text-xs">{{ $debate->created_at->diffForHumans() }}</span>
                                        
                                        @if(auth()->id() === $debate->user_id)
                                            <button @click="inModifica = true" x-show="!inModifica" class="text-xs font-bold text-[#3d8bff] hover:text-[#5e9eff] transition-colors">
                                                Modifica
                                            </button>

                                            <form x-show="!inModifica" method="POST" action="{{ route('debates.destroy', $debate) }}" class="inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo dibattito?')" class="text-xs font-bold text-[#ff4757] hover:text-[#ff6b78] transition-colors">
                                                    Elimina
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                {{-- Renderizzazione Titolo e Messaggio --}}
                                <div x-show="!inModifica">
                                    <h3 class="text-white font-black text-xl mb-1.5 tracking-tight" style="font-family:'Syne',sans-serif;">
                                        {{ $debate->title }}
                                    </h3>
                                    <p class="text-zinc-300 text-sm leading-relaxed">
                                        {{ $debate->message }}
                                    </p>
                                </div>

                                {{-- Form di Modifica Inline (Inclusione Titolo) --}}
                                @if(auth()->id() === $debate->user_id)
                                    <form x-cloak x-show="inModifica" method="POST" action="{{ route('debates.update', $debate) }}" class="mt-2">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <input 
                                            type="text" 
                                            name="title" 
                                            value="{{ $debate->title }}"
                                            class="w-full bg-[#0a0a0f] text-white border border-[#1e1e2e] rounded-xl p-3 text-sm font-bold focus:ring-0 focus:border-[#3d8bff] transition-colors mb-2"
                                            required
                                        >

                                        <textarea 
                                            name="message" 
                                            rows="3" 
                                            class="w-full bg-[#0a0a0f] text-white border border-[#1e1e2e] rounded-xl p-3 text-sm focus:ring-0 focus:border-[#3d8bff] transition-colors resize-none"
                                            required
                                        >{{ $debate->message }}</textarea>
                                        
                                        <div class="flex justify-end mt-2 gap-2">
                                            <button type="button" @click="inModifica = false" class="px-3 py-1.5 rounded-lg text-zinc-400 text-xs font-bold hover:text-white transition-colors">
                                                Annulla
                                            </button>
                                            <button type="submit" class="px-4 py-1.5 rounded-lg bg-[#3d8bff] text-white text-xs font-bold hover:bg-[#5e9eff] transition-colors">
                                                Salva modifiche
                                            </button>
                                        </div>
                                    </form>
                                @endif

                                {{-- Barra delle Interazioni --}}
                                <div class="flex items-center gap-6 mt-4 pt-4 border-t border-[#1e1e2e]">
                                    
                                    {{-- Bottone Like --}}
                                    <button @click="toggleLike()" :class="liked ? 'text-[#ff4757]' : 'text-zinc-500 hover:text-[#ff4757]'" class="flex items-center gap-2 text-sm font-bold transition-colors">
                                        <svg width="20" height="20" :fill="liked ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                        <span x-text="likesCount"></span>
                                    </button>

                                    {{-- Bottone Commenti --}}
                                    <button @click="mostraCommenti = !mostraCommenti" class="flex items-center gap-2 text-sm font-bold text-zinc-500 hover:text-[#3d8bff] transition-colors">
                                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                        </svg>
                                        <span x-text="commentsCount"></span>
                                    </button>
                                </div>

                                {{-- Sezione Commenti --}}
                                <div x-show="mostraCommenti" x-cloak class="mt-4 space-y-4">
                                    
                                    {{-- Form Inserimento Commento --}}
                                    <form @submit.prevent="inviaCommento" class="flex gap-3">
                                        <div class="w-8 h-8 rounded-full bg-[#e8ff47]/15 flex items-center justify-center text-[#e8ff47] font-bold text-xs flex-shrink-0 mt-1">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                        <div class="flex-1">
                                            <textarea 
                                                x-model="nuovoCommento"
                                                rows="1" 
                                                class="w-full bg-[#0a0a0f] text-white border border-[#1e1e2e] rounded-xl p-3 text-sm focus:ring-0 focus:border-[#e8ff47] transition-colors resize-none placeholder-zinc-600"
                                                placeholder="Scrivi una risposta..."
                                                required
                                            ></textarea>
                                            <div class="flex justify-end mt-2">
                                                <button type="submit" class="px-4 py-1.5 rounded-lg bg-[#e8ff47] text-black text-xs font-bold hover:bg-[#d4eb30] transition-colors">
                                                    Rispondi
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    {{-- Lista dei Commenti --}}
                                    <div class="space-y-3">
                                        @foreach($debate->comments as $comment)
                                            <div class="flex gap-3 bg-[#0a0a0f]/50 rounded-xl p-3 border border-[#1e1e2e]/50">
                                                <div class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-300 font-bold text-xs flex-shrink-0">
                                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span class="font-bold text-white text-xs">{{ $comment->user->name }}</span>
                                                        
                                                        <span class="text-zinc-600 text-[10px]">{{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-zinc-400 text-sm leading-relaxed">
                                                        {{ $comment->body }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- Nuovi commenti AJAX via Template Alpine --}}
                                        <template x-for="comment in commentiAggiunti">
                                            <div class="flex gap-3 bg-[#0a0a0f]/50 rounded-xl p-3 border border-[#1e1e2e]/50">
                                                <div class="w-8 h-8 rounded-full bg-[#e8ff47]/15 flex items-center justify-center text-[#e8ff47] font-bold text-xs flex-shrink-0" x-text="comment.initials || '{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}'">
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span class="font-bold text-white text-xs" x-text="comment.user_name || '{{ auth()->user()->name }}'"></span>
                                                        <span class="text-[#e8ff47]/80 text-[10px]">Proprio ora</span>
                                                    </div>
                                                    <p class="text-zinc-400 text-sm leading-relaxed" x-text="comment.body"></p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-4">


            <div class="bg-[#111118] border-2 border-[#dfff00] shadow-[0_0_15px_rgba(223,255,0,0.15)] rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></div>
                    <h3 class="font-black text-yellow-400 text-xs uppercase tracking-widest flex items-center gap-1">
                       🔥 Sfida del Giorno 🔥
                    </h3>
                </div>
                
                @if(isset($dailyTopic) && $dailyTopic)
                    <p class="text-white text-lg font-semibold leading-relaxed mb-4">
                        {{ $dailyTopic->topic }}
                    </p>

                    {{-- Sezione Info (Senza Redirect) --}}
                    <div class="pt-4 border-t border-[#1e1e2e]">
                        <p class="text-zinc-400 text-sm">
                            Discutine nella sezione dedicata.
                        </p>
                    </div>
                @else
                    <p class="text-zinc-500 italic">Nessuna sfida impostata per oggi.</p>
                @endif
            </div>
            {{-- FINE BLOCCO SFIDA DEL GIORNO --}}

                {{-- Trending topics --}}
                <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-5">
                    <div class="text-xs font-bold uppercase tracking-widest text-zinc-500 mb-4">🔥 Trending</div>
                    @php
                    $trending = [
                        ['topic' => 'IA e mercato del lavoro', 'count' => '2.1K'],
                        ['topic' => 'Smart working: pro e contro', 'count' => '1.8K'],
                        ['topic' => 'Crypto vs euro digitale', 'count' => '967'],
                        ['topic' => 'Vegano vs onnivoro', 'count' => '754'],
                        ['topic' => 'Università vs bootcamp', 'count' => '612'],
                    ];
                    @endphp
                    @foreach($trending as $i => $t)
                    <div class="flex items-center gap-3 py-2.5 {{ !$loop->last ? 'border-b border-[#1e1e2e]' : '' }}">
                        <span class="text-xs font-black text-[#e8ff47] w-5 flex-shrink-0" style="font-family:'Syne',sans-serif;">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="text-sm text-zinc-300 flex-1 leading-tight">{{ $t['topic'] }}</span>
                        <span class="text-xs text-zinc-600">{{ $t['count'] }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Profilo quick --}}
                <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-[#e8ff47]/15 flex items-center justify-center text-[#e8ff47] font-black text-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-bold text-sm text-white">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-zinc-500">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <a href="{{ route('profile') }}" wire:navigate class="flex items-center justify-center gap-2 w-full py-2 rounded-xl border border-zinc-800 text-zinc-400 text-xs font-bold hover:border-zinc-700 hover:text-white transition-colors">
                        Modifica profilo
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
</x-app-layout>