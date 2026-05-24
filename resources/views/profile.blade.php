<x-app-layout>
<div class="min-h-screen bg-[#0a0a0f] text-white pt-16" style="font-family:'DM Sans',sans-serif;">
 
    {{-- Glow --}}
    <div class="fixed pointer-events-none inset-0 overflow-hidden z-0">
        <div class="absolute -top-40 left-1/3 w-[500px] h-[500px] bg-[#c084fc]/4 rounded-full blur-[160px]"></div>
    </div>
 
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
 
        {{-- Page header --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('dashboard') }}" wire:navigate class="text-zinc-500 hover:text-white text-sm flex items-center gap-1.5 transition-colors">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                    Dashboard
                </a>
                <span class="text-zinc-700">/</span>
                <span class="text-sm text-zinc-400">Profilo</span>
            </div>
            <h1 class="text-3xl font-black tracking-tight" style="font-family:'Syne',sans-serif;">
                Il tuo profilo
            </h1>
            <p class="text-zinc-500 text-sm mt-1">Gestisci le tue informazioni personali e le impostazioni di sicurezza.</p>
        </div>
 
        {{-- Avatar card --}}
        <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-6 flex items-center gap-5">
            <div class="w-16 h-16 rounded-2xl bg-[#e8ff47]/15 flex items-center justify-center text-[#e8ff47] font-black text-3xl flex-shrink-0" style="font-family:'Syne',sans-serif;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <div class="font-black text-xl" style="font-family:'Syne',sans-serif;">{{ auth()->user()->name }}</div>
                <div class="text-sm text-zinc-500">{{ auth()->user()->email }}</div>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full bg-[#e8ff47]/10 text-[#e8ff47] border border-[#e8ff47]/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#e8ff47]"></span>
                        Debater
                    </span>
                </div>
            </div>
        </div>
 
        {{-- Update profile info --}}
        <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-[#1e1e2e] flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-[#3d8bff]/10 flex items-center justify-center">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#3d8bff" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-sm text-white" style="font-family:'Syne',sans-serif;">Informazioni personali</h2>
                    <p class="text-xs text-zinc-500">Aggiorna nome e indirizzo email</p>
                </div>
            </div>
            <div class="p-6">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>
 
        {{-- Update password --}}
        <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-[#1e1e2e] flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-[#e8ff47]/10 flex items-center justify-center">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#e8ff47" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-sm text-white" style="font-family:'Syne',sans-serif;">Sicurezza</h2>
                    <p class="text-xs text-zinc-500">Cambia la password di accesso</p>
                </div>
            </div>
            <div class="p-6">
                <livewire:profile.update-password-form />
            </div>
        </div>
 
        {{-- Delete account --}}
        <div class="bg-[#111118] border border-[#ff4757]/20 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-[#ff4757]/15 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-[#ff4757]/10 flex items-center justify-center">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#ff4757" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-sm text-[#ff4757]" style="font-family:'Syne',sans-serif;">Zona pericolosa</h2>
                    <p class="text-xs text-zinc-500">Elimina definitivamente il tuo account</p>
                </div>
            </div>
            <div class="p-6">
                <livewire:profile.delete-user-form />
            </div>
        </div>
 
    </div>
</div>
</x-app-layout>
 