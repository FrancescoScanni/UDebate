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

            {{-- Utenti --}}
            <a href="{{ route('moderator.users') }}" class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-6 hover:border-zinc-700 transition-colors cursor-pointer group block">
                <div class="w-10 h-10 rounded-xl bg-[#3d8bff]/10 flex items-center justify-center text-[#3d8bff] mb-4 group-hover:bg-[#3d8bff]/20 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                    </svg>
                </div>
                <h3 class="font-black text-white text-lg mb-1" style="font-family:'Syne',sans-serif;">Utenti</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Visualizza e gestisci gli utenti registrati sulla piattaforma.</p>
                <div class="mt-4 flex items-center gap-1.5 text-[#3d8bff] text-xs font-bold">
                    Gestisci
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </div>
            </a>

            {{-- Dibattiti --}}
            <a href="{{ route('moderator.debates') }}" class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-6 hover:border-zinc-700 transition-colors cursor-pointer group block">
                <div class="w-10 h-10 rounded-xl bg-[#e8ff47]/10 flex items-center justify-center text-[#e8ff47] mb-4 group-hover:bg-[#e8ff47]/20 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z"/>
                    </svg>
                </div>
                <h3 class="font-black text-white text-lg mb-1" style="font-family:'Syne',sans-serif;">Dibattiti</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Visualizza, modifica ed elimina tutti i dibattiti della piattaforma.</p>
                <div class="mt-4 flex items-center gap-1.5 text-[#e8ff47] text-xs font-bold">
                    Gestisci
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </div>
            </a>

        </div>
    </div>
</div>
</x-app-layout>