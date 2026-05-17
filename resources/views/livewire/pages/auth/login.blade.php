<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-[#0a0a0c] text-white flex flex-col justify-center items-center p-4 font-sans selection:bg-[#D4FF3A] selection:text-black">
    
    <div class="w-full max-w-md bg-zinc-900/40 border border-zinc-800/80 rounded-3xl shadow-2xl backdrop-blur-sm p-8 sm:p-10">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-black tracking-tight text-white mb-3">
                Bentornato su <span class="text-[#D4FF3A]">UDebate</span>
            </h2>
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-[#D4FF3A]/20 bg-[#D4FF3A]/5 text-[10px] font-bold tracking-widest text-[#D4FF3A] uppercase">
                <span class="w-1.5 h-1.5 rounded-full bg-[#D4FF3A] animate-pulse"></span>
                Il social media del confronto
            </div>
        </div>

        <x-auth-session-status class="mb-4 text-center text-[#D4FF3A] text-sm font-medium" :status="session('status')" />

        <form wire:submit="login" class="space-y-6">
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2" />
                <x-text-input 
                    wire:model="form.email" 
                    id="email" 
                    class="block w-full bg-zinc-950/60 border border-zinc-800 text-white rounded-xl px-4 py-3.5 focus:border-[#D4FF3A] focus:ring-1 focus:ring-[#D4FF3A] transition-colors placeholder:text-zinc-600" 
                    type="email" 
                    name="email" 
                    required 
                    autofocus 
                    autocomplete="username" 
                    placeholder="nome@esempio.com" 
                />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-500 text-xs font-medium" />
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <x-input-label for="password" :value="__('Password')" class="text-xs font-bold text-zinc-400 uppercase tracking-wider" />
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" wire:navigate class="text-xs font-medium text-zinc-500 hover:text-[#D4FF3A] transition-colors">
                            {{ __('Dimenticata?') }}
                        </a>
                    @endif
                </div>
                <x-text-input 
                    wire:model="form.password" 
                    id="password" 
                    class="block w-full bg-zinc-950/60 border border-zinc-800 text-white rounded-xl px-4 py-3.5 focus:border-[#D4FF3A] focus:ring-1 focus:ring-[#D4FF3A] transition-colors placeholder:text-zinc-600" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                    placeholder="••••••••" 
                />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-500 text-xs font-medium" />
            </div>

            <div class="flex items-center">
                <label for="remember" class="flex items-center cursor-pointer group">
                    <input 
                        wire:model="form.remember" 
                        id="remember" 
                        type="checkbox" 
                        name="remember"
                        class="rounded bg-zinc-950 border-zinc-700 text-[#D4FF3A] focus:ring-[#D4FF3A] focus:ring-offset-zinc-900 w-4 h-4 transition-colors" 
                    />
                    <span class="ml-2.5 text-sm font-medium text-zinc-400 group-hover:text-zinc-300 transition-colors select-none">
                        {{ __('Rimani connesso') }}
                    </span>
                </label>
            </div>

            <div class="pt-2 flex flex-col gap-3">
                <button type="submit" class="w-full bg-[#D4FF3A] hover:bg-[#c2eb2b] text-black font-extrabold text-sm py-3.5 px-4 rounded-xl transition-all duration-200 shadow-[0_0_15px_rgba(212,255,58,0.15)] flex justify-center items-center gap-2 transform active:scale-[0.98]">
                    {{ __('Accedi ora') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
                
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="w-full text-center py-3.5 px-4 bg-transparent hover:bg-zinc-800 border border-zinc-700 text-zinc-300 font-semibold rounded-xl transition-colors text-sm" wire:navigate>
                        {{ __('Non ho un account') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>