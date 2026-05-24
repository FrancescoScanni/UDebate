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
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight leading-tight mb-3" style="font-family:'Syne',sans-serif;">
                Ciao, {{ auth()->user()->name }}.<br>
                <span class="text-zinc-500">Cosa dibatti oggi?</span>
            </h1>
        </div>

        {{-- Stats row --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-10">
            @php
            $stats = [
                ['label' => 'Dibattiti aperti', 'value' => '0', 'icon' => '💬', 'color' => 'e8ff47'],
                ['label' => 'Voti ricevuti', 'value' => '0', 'icon' => '🗳️', 'color' => '3d8bff'],
                ['label' => 'Risposte', 'value' => '0', 'icon' => '↩️', 'color' => 'c084fc'],
                ['label' => 'Reputazione', 'value' => '0', 'icon' => '⚡', 'color' => 'ff4757'],
            ];
            @endphp
            @foreach($stats as $s)
            <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-4 sm:p-5 hover:border-zinc-700 transition-colors">
                <div class="text-2xl mb-2">{{ $s['icon'] }}</div>
                <div class="text-2xl font-black" style="font-family:'Syne',sans-serif;color:#{{ $s['color'] }}">{{ $s['value'] }}</div>
                <div class="text-xs text-zinc-500 mt-0.5 font-medium">{{ $s['label'] }}</div>
            </div>
            @endforeach
        </div>

        {{-- Main grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Feed area --}}
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between mb-1">
                    <h2 class="font-black text-lg" style="font-family:'Syne',sans-serif;">Feed</h2>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 rounded-lg bg-[#e8ff47]/10 text-[#e8ff47] text-xs font-bold border border-[#e8ff47]/20">Tutti</button>
                        <button class="px-3 py-1.5 rounded-lg text-zinc-500 text-xs font-bold border border-transparent hover:border-zinc-800 transition-colors">Seguiti</button>
                    </div>
                </div>

                {{-- New debate CTA --}}
                <div class="bg-[#111118] border border-dashed border-[#e8ff47]/25 rounded-2xl p-5 flex items-center gap-4 hover:border-[#e8ff47]/50 transition-colors cursor-pointer group">
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

                {{-- Empty state --}}
                <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-12 text-center">
                    <div class="text-5xl mb-4">⚖️</div>
                    <h3 class="font-black text-lg mb-2" style="font-family:'Syne',sans-serif;">Il feed è vuoto</h3>
                    <p class="text-zinc-500 text-sm max-w-xs mx-auto leading-relaxed">
                        Non ci sono ancora dibattiti. Sii il primo ad aprire una discussione e far partire il confronto.
                    </p>
                    <button class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#e8ff47] text-black text-sm font-extrabold hover:bg-[#d4eb30] transition-colors">
                        Inizia tu
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-4">

                {{-- Sfida del giorno --}}
                <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-5">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#e8ff47]">⚡ Sfida del giorno</span>
                    </div>
                    <p class="text-sm text-zinc-300 leading-relaxed mb-4 border border-[#e8ff47]/15 bg-[#e8ff47]/5 rounded-xl p-3">
                        "Il colonialismo spaziale è un rischio reale con l'esplorazione privata?"
                    </p>
                    <div class="flex gap-2">
                        <button class="flex-1 py-2 rounded-xl bg-[#e8ff47]/10 text-[#e8ff47] text-xs font-bold border border-[#e8ff47]/20 hover:bg-[#e8ff47]/20 transition-colors">
                            ↑ Sì
                        </button>
                        <button class="flex-1 py-2 rounded-xl bg-[#ff4757]/10 text-[#ff4757] text-xs font-bold border border-[#ff4757]/20 hover:bg-[#ff4757]/20 transition-colors">
                            ↓ No
                        </button>
                    </div>
                </div>

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