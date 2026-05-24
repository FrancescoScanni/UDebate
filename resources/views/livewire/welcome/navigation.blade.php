<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false, scrolled: false }" 
     x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
     :class="scrolled ? 'bg-[#0a0a0f]/95 backdrop-blur-xl border-b border-[#1e1e2e]' : 'bg-[#0a0a0f] border-b border-[#1e1e2e]'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" wire:navigate class="font-black text-xl tracking-tighter uppercase text-white">
                U<span class="text-[#e8ff47]">Debate</span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden sm:flex items-center gap-1">
                <a href="{{ route('dashboard') }}" wire:navigate
                   class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200
                          {{ request()->routeIs('dashboard') 
                             ? 'text-[#e8ff47] bg-[#e8ff47]/10' 
                             : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
                    </svg>
                    Dashboard
                </a>
            </div>

            {{-- User Menu --}}
            <div class="hidden sm:flex items-center gap-3">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                            class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-zinc-800 bg-zinc-900/60 hover:border-zinc-700 hover:bg-zinc-900 transition-all duration-200 cursor-pointer">
                        <div class="w-7 h-7 rounded-full bg-[#e8ff47]/15 flex items-center justify-center text-[#e8ff47] text-xs font-black">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-semibold text-white" 
                              x-data="{{ json_encode(['name' => auth()->user()->name]) }}" 
                              x-text="name" 
                              x-on:profile-updated.window="name = $event.detail.name">
                        </span>
                        <svg class="w-3.5 h-3.5 text-zinc-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95 -translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-52 rounded-2xl border border-zinc-800 bg-[#111118] shadow-2xl shadow-black/50 overflow-hidden">
                        <div class="p-1">
                            <a href="{{ route('profile') }}" wire:navigate
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-zinc-300 hover:text-white hover:bg-white/5 transition-colors">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                                Profilo
                            </a>
                        </div>
                        <div class="border-t border-zinc-800 p-1">
                            <button wire:click="logout" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-zinc-500 hover:text-red-400 hover:bg-red-500/5 transition-colors text-left">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                                </svg>
                                Disconnetti
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mobile Hamburger --}}
            <button @click="open = !open" class="sm:hidden p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-white/5 transition-colors">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-zinc-800 bg-[#0a0a0f]">
        <div class="p-4 space-y-1">
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('dashboard') ? 'text-[#e8ff47] bg-[#e8ff47]/10' : 'text-zinc-400' }}">
                Dashboard
            </a>
        </div>
        <div class="border-t border-zinc-800 p-4 space-y-1">
            <div class="px-3 pb-3">
                <div class="font-bold text-sm text-white" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="text-xs text-zinc-500">{{ auth()->user()->email }}</div>
            </div>
            <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-zinc-400 hover:text-white">
                Profilo
            </a>
            <button wire:click="logout" class="w-full flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-zinc-500 hover:text-red-400 text-left">
                Disconnetti
            </button>
        </div>
    </div>
</nav>