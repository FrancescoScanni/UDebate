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

<nav x-data="{ open: false }" class="fixed top-0 inset-x-0 z-50 bg-[#0a0a0f]/80 backdrop-blur-md border-b border-white/5 w-full" style="font-family:'DM Sans',sans-serif;">

    {{-- Linea accent superiore --}}
    <div class="h-[2px] bg-gradient-to-r from-transparent via-[#e8ff47]/40 to-transparent"></div>

    <div class="w-full px-6 sm:px-10 lg:px-16">
        <div class="flex justify-between items-center h-14">

            {{-- Logo + link principali --}}
            <div class="flex items-center gap-8">

                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 group">
                    <x-application-logo class="h-6 w-auto fill-current text-[#e8ff47] group-hover:text-white transition-colors duration-200" />
                    <span class="text-sm font-black tracking-widest text-white uppercase" style="font-family:'Syne',sans-serif;">
                        UDebate
                    </span>
                </a>

                {{-- Nav links desktop --}}
                <div class="hidden sm:flex items-center gap-1">
                    <a href="{{ route('dashboard') }}" wire:navigate
                       class="{{ request()->routeIs('dashboard')
                           ? 'text-[#e8ff47] bg-[#e8ff47]/8 border border-[#e8ff47]/20'
                           : 'text-zinc-400 border border-transparent hover:text-white hover:bg-white/5' }}
                           px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider transition-all duration-150">
                        Dashboard
                    </a>
                </div>
            </div>

            {{-- Destra: dropdown utente --}}
            <div class="hidden sm:flex items-center gap-3">

                {{-- Indicatore "live" --}}
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#e8ff47]/8 border border-[#e8ff47]/15">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#e8ff47] animate-pulse"></span>
                    <span class="text-[10px] font-bold text-[#e8ff47] uppercase tracking-widest">Live</span>
                </div>

                {{-- Dropdown utente --}}
                <x-dropdown align="right" width="48" contentClasses="py-1 bg-[#111118] border border-[#1e1e2e] rounded-xl shadow-xl shadow-black/40">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-[#1e1e2e] bg-[#111118] hover:border-zinc-700 hover:bg-[#16171d] transition-all duration-150 group">
                            <div class="w-6 h-6 rounded-full bg-[#e8ff47]/15 flex items-center justify-center text-[#e8ff47] font-black text-[10px] flex-shrink-0">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-xs font-bold text-zinc-300 group-hover:text-white transition-colors"
                                  x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                  x-text="name"
                                  x-on:profile-updated.window="name = $event.detail.name">
                            </span>
                            <svg class="h-3 w-3 text-zinc-600 group-hover:text-zinc-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-[#1e1e2e]">
                            <p class="text-xs font-black text-white" style="font-family:'Syne',sans-serif;">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-zinc-500 mt-0.5 truncate">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="py-1">
                            <a href="{{ route('profile') }}" wire:navigate
                               class="flex items-center gap-2.5 px-4 py-2 text-xs font-bold text-zinc-400 hover:text-white hover:bg-white/5 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                                Profilo
                            </a>

                            <div class="border-t border-[#1e1e2e] mt-1 pt-1">
                                <button wire:click="logout" class="w-full flex items-center gap-2.5 px-4 py-2 text-xs font-bold text-[#ff4757] hover:text-[#ff6b78] hover:bg-[#ff4757]/5 transition-colors text-start">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                                    </svg>
                                    Esci
                                </button>
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger mobile --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="p-2 rounded-lg text-zinc-500 hover:text-[#e8ff47] hover:bg-[#e8ff47]/5 border border-transparent hover:border-[#e8ff47]/20 transition-all duration-150">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Menu mobile --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-white/5 bg-[#0a0a0f]">

        <div class="px-4 pt-3 pb-2 space-y-1">
            <a href="{{ route('dashboard') }}" wire:navigate
               class="{{ request()->routeIs('dashboard') ? 'text-[#e8ff47] bg-[#e8ff47]/8 border-[#e8ff47]/20' : 'text-zinc-400 border-transparent hover:text-white hover:bg-white/5' }}
                      flex items-center px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border transition-all">
                Dashboard
            </a>
        </div>

        {{-- Profilo mobile --}}
        <div class="px-4 pt-3 pb-4 border-t border-white/5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-[#e8ff47]/15 flex items-center justify-center text-[#e8ff47] font-black text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-white"
                       x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                       x-text="name"
                       x-on:profile-updated.window="name = $event.detail.name"></p>
                    <p class="text-xs text-zinc-500">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile') }}" wire:navigate
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-bold text-zinc-400 hover:text-white hover:bg-white/5 border border-transparent transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                    </svg>
                    Profilo
                </a>

                <button wire:click="logout" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-bold text-[#ff4757] hover:bg-[#ff4757]/5 border border-transparent transition-all text-start">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                    </svg>
                    Esci
                </button>
            </div>
        </div>
    </div>

</nav>