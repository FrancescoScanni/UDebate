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

<div class="h-screen w-screen bg-[#0a0a0c] text-white flex flex-col md:flex-row font-sans selection:bg-[#D4FF3A] selection:text-black overflow-hidden">
    
    <div class="w-full md:w-1/2 h-1/2 md:h-full flex flex-col justify-between p-8 sm:p-12 md:p-16 relative overflow-hidden bg-zinc-950">
        
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#D4FF3A]/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="relative z-10">
            <span class="text-2xl font-black tracking-tighter uppercase text-white">
                U<span class="text-[#D4FF3A]">Debate</span>
            </span>
        </div>

        <div class="my-auto py-4 relative z-10 max-w-md">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-[#D4FF3A]/10 bg-[#D4FF3A]/5 text-[10px] font-bold tracking-widest text-[#D4FF3A] uppercase mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#D4FF3A] animate-pulse"></span>
                Il social media del confronto
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-white leading-tight mb-4">
                Bentornato nell'<span class="text-[#D4FF3A]">arena</span>.
            </h1>
            <p class="text-zinc-400 text-sm leading-relaxed">
                Accedi per riprendere da dove avevi lasciato. Continua a difendere le tue tesi, rispondi alle argomentazioni e fai valere la tua opinione.
            </p>
        </div>

        <div class="relative z-10 text-[11px] text-zinc-600 hidden md:block">
            © {{ date('Y') }} UDebate. Tutti i diritti riservati.
        </div>
    </div>

    <div class="w-full md:w-1/2 h-1/2 md:h-full flex flex-col justify-center items-center p-8 sm:p-12 md:p-16 bg-[#0c0c0e] overflow-y-auto md:overflow-hidden">
        
        <div class="w-full max-w-md space-y-6 my-auto">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-white sm:text-3xl">
                    Accedi al tuo account
                </h2>
                <p class="text-sm text-zinc-500 mt-1">
                    Inserisci le tue credenziali per continuare.
                </p>
            </div>

            <x-auth-session-status class="mb-4 text-[#D4FF3A] text-sm font-medium" :status="session('status')" />

            <form wire:submit="login" class="space-y-4">
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-1.5" />
                    <x-text-input 
                        wire:model="form.email" 
                        id="email" 
                        class="block w-full bg-zinc-950/60 border border-zinc-850 text-white rounded-xl px-4 py-3 focus:border-[#D4FF3A] focus:ring-1 focus:ring-[#D4FF3A] transition-colors placeholder:text-zinc-700 text-sm" 
                        type="email" 
                        name="email" 
                        required 
                        autofocus 
                        autocomplete="username" 
                        placeholder="nome@esempio.com" 
                    />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-1 text-red-500 text-xs font-medium" />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
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
                        class="block w-full bg-zinc-950/60 border border-zinc-850 text-white rounded-xl px-4 py-3 focus:border-[#D4FF3A] focus:ring-1 focus:ring-[#D4FF3A] transition-colors placeholder:text-zinc-700 text-sm" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                        placeholder="••••••••" 
                    />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-1 text-red-500 text-xs font-medium" />
                </div>

                <div class="flex items-center pt-1">
                    <label for="remember" class="flex items-center cursor-pointer group">
                        <input 
                            wire:model="form.remember" 
                            id="remember" 
                            type="checkbox" 
                            name="remember"
                            class="rounded bg-zinc-950 border-zinc-800 text-[#D4FF3A] focus:ring-[#D4FF3A] focus:ring-offset-zinc-900 w-4 h-4 transition-colors" 
                        />
                        <span class="ml-2.5 text-sm font-medium text-zinc-400 group-hover:text-zinc-300 transition-colors select-none">
                            {{ __('Rimani connesso') }}
                        </span>
                    </label>
                </div>

                <div class="pt-2 flex flex-col gap-2.5">
                    <button type="submit" class="w-full bg-[#D4FF3A] hover:bg-[#c2eb2b] text-black font-extrabold text-sm py-3 px-4 rounded-xl transition-all duration-200 shadow-[0_0_20px_rgba(212,255,58,0.1)] flex justify-center items-center gap-2 transform active:scale-[0.98]">
                        {{ __('Accedi ora') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full text-center py-3 px-4 bg-transparent hover:bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white font-semibold rounded-xl transition-colors text-sm" wire:navigate>
                            {{ __('Non hai un account? Registrati') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>

    </div>
</div>