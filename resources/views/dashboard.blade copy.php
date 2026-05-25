<x-app-layout>
<div class="min-h-screen bg-[#0a0a0f] text-white pt-16" style="font-family:'DM Sans',sans-serif;">

    {{-- Glow blobs --}}
    <div class="fixed pointer-events-none inset-0 overflow-hidden z-0">
        <div class="absolute -top-60 -left-40 w-[500px] h-[500px] bg-[#ff4757]/5 rounded-full blur-[140px]"></div>
        <div class="absolute top-1/2 -right-60 w-[400px] h-[400px] bg-[#3d8bff]/5 rounded-full blur-[140px]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Header --}}
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-2 h-2 rounded-full bg-[#ff4757] animate-pulse"></div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#ff4757]">Pannello moderazione</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-bold tracking-normal leading-tight mb-3" style="font-family:'Inter',sans-serif;">
                Ciao, {{ auth()->user()->name }}<br>
                <span class="text-zinc-500 sm:text-5xl font-normal">Cosa moderi oggi?</span>
            </h1>
        </div>

        {{-- Menu opzioni --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            {{-- Gestione dibattiti --}}
            <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-6 hover:border-zinc-700 transition-colors cursor-pointer group">
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
            </div>

            {{-- Gestione utenti --}}
            <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-6 hover:border-zinc-700 transition-colors cursor-pointer group">
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
            </div>

            {{-- Gestione commenti --}}
            <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-6 hover:border-zinc-700 transition-colors cursor-pointer group">
                <div class="w-10 h-10 rounded-xl bg-[#c084fc]/10 flex items-center justify-center text-[#c084fc] mb-4 group-hover:bg-[#c084fc]/20 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                    </svg>
                </div>
                <h3 class="font-black text-white text-lg mb-1" style="font-family:'Syne',sans-serif;">Commenti</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Modera i commenti e rimuovi contenuti inappropriati.</p>
                <div class="mt-4 flex items-center gap-1.5 text-[#c084fc] text-xs font-bold">
                    Gestisci
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </div>
            </div>

            {{-- Statistiche --}}
            <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-6 hover:border-zinc-700 transition-colors cursor-pointer group">
                <div class="w-10 h-10 rounded-xl bg-[#ff4757]/10 flex items-center justify-center text-[#ff4757] mb-4 group-hover:bg-[#ff4757]/20 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/>
                    </svg>
                </div>
                <h3 class="font-black text-white text-lg mb-1" style="font-family:'Syne',sans-serif;">Statistiche</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Panoramica generale sull'attività della piattaforma.</p>
                <div class="mt-4 flex items-center gap-1.5 text-[#ff4757] text-xs font-bold">
                    Visualizza
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </div>
            </div>

            {{-- Impostazioni --}}
            <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-6 hover:border-zinc-700 transition-colors cursor-pointer group">
                <div class="w-10 h-10 rounded-xl bg-zinc-800 flex items-center justify-center text-zinc-400 mb-4 group-hover:bg-zinc-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </div>
                <h3 class="font-black text-white text-lg mb-1" style="font-family:'Syne',sans-serif;">Impostazioni</h3>
                <p class="text-zinc-500 text-sm leading-relaxed">Configura le impostazioni generali della piattaforma.</p>
                <div class="mt-4 flex items-center gap-1.5 text-zinc-400 text-xs font-bold">
                    Configura
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </div>
            </div>

        </div>
    </div>
</div>
</x-app-layout>