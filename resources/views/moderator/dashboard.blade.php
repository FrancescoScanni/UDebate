<x-app-layout>
    <div class="min-h-screen bg-[#0a0a0f] text-white pt-16" style="font-family:'DM Sans',sans-serif;">

        <div class="fixed pointer-events-none inset-0 overflow-hidden z-0">
            <div class="absolute -top-60 -left-40 w-[500px] h-[500px] bg-[#ff4757]/5 rounded-full blur-[140px]"></div>
            <div class="absolute top-1/2 -right-60 w-[400px] h-[400px] bg-[#3d8bff]/5 rounded-full blur-[140px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-2 h-2 rounded-full bg-[#ff4757] animate-pulse"></div>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#ff4757]">Pannello moderazione</span>
                </div>
                <h1 class="text-4xl sm:text-6xl font-bold tracking-normal leading-tight mb-3" style="font-family:'Inter',sans-serif;">
                    Ciao, {{ auth()->user()->name }}<br>
                    <span class="text-zinc-500 sm:text-5xl font-normal">Cosa moderi oggi?</span>
                </h1>

                <div class="flex items-center gap-6 mt-6">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-black text-[#3d8bff]" style="font-family:'Syne',sans-serif;">{{ $usersCount }}</span>
                        <span class="text-xs text-zinc-500 uppercase tracking-wider">Utenti</span>
                    </div>
                    <div class="w-px h-6 bg-[#1e1e2e]"></div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-black text-[#e8ff47]" style="font-family:'Syne',sans-serif;">{{ $debatesCount }}</span>
                        <span class="text-xs text-zinc-500 uppercase tracking-wider">Dibattiti</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <div class="mt-8 bg-[#111118] border border-[#1e1e2e] rounded-2xl p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-[#e8ff47]/10 flex items-center justify-center text-[#e8ff47]">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.364-5.657l-.707.707M12 21v-1M4.707 18.707l.707-.707M17.293 18.707l-.707-.707M12 10a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-black text-white text-lg" style="font-family:'Syne',sans-serif;">Topic del Giorno</h3>
                            <p class="text-zinc-500 text-xs uppercase tracking-wider font-bold">Imposta il tema della discussione</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.updateTopic') }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                        @csrf
                        <input type="text" name="topic" 
                               value="{{ $currentTopic->topic ?? '' }}"
                               placeholder="Es: L'impatto dell'IA nel 2026..." 
                               class="flex-1 bg-[#0a0a0f] border border-[#1e1e2e] rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-[#e8ff47] focus:border-transparent outline-none transition-all">
                        
                        <button type="submit" class="bg-[#e8ff47] text-[#0a0a0f] font-black px-8 py-3 rounded-xl hover:bg-white transition-colors">
                            Aggiorna
                        </button>
                    </form>
                    
                    @if($currentTopic)
                        <p class="mt-4 text-zinc-500 text-xs">Topic attivo impostato il: {{ $currentTopic->created_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>