<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-[#0a0a0c] text-white flex flex-col md:flex-row font-sans selection:bg-[#D4FF3A] selection:text-black">
    
    <div class="w-full md:w-1/2 flex flex-col justify-between p-8 sm:p-12 md:p-16 relative overflow-hidden bg-zinc-950">
        
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#D4FF3A]/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="relative z-10 flex items-center justify-between">
            <span class="text-2xl font-black tracking-tighter uppercase text-white">
                U<span class="text-[#D4FF3A]">Debate</span>
            </span>
            <div class="px-3 py-1 rounded-full border border-zinc-800 bg-zinc-900 text-[10px] font-medium text-zinc-400 uppercase tracking-wider">
                Nuovo Profilo
            </div>
        </div>

        <div class="my-auto pt-12 pb-8 relative z-10 max-w-md">
            <h1 class="text-4xl sm:text-5xl font-black tracking-tight text-white leading-tight mb-5">
                La tua opinione<br />merita uno<br /><span class="text-[#D4FF3A]">pubblico vero.</span>
            </h1>
            <p class="text-zinc-400 text-sm leading-relaxed mb-8">
                Non lasciare i tuoi pensieri chiusi in un commento ignorato. Crea la tua identità di debater, accumula punti reputazione e confrontati con i migliori del web.
            </p>

            <div class="relative border-l border-zinc-800 ml-3 space-y-6">
                <div class="relative pl-6">
                    <div class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-[#D4FF3A] ring-4 ring-[#D4FF3A]/10"></div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">01. Configura il profilo</h3>
                    <p class="text-xs text-zinc-500 mt-0.5">Scegli il tuo nome di battaglia nella community.</p>
                </div>
                <div class="relative pl-6">
                    <div class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-zinc-700"></div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-400">02. Seleziona i tuoi Topic</h3>
                    <p class="text-xs text-zinc-500 mt-0.5">Scegli gli argomenti di cui sei più esperto o appassionato.</p>
                </div>
                <div class="relative pl-6">
                    <div class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-zinc-700"></div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-400">03. Entra nell'Arena</h3>
                    <p class="text-xs text-zinc-500 mt-0.5">Lancia il tuo primo dibattito o rispondi a uno già aperto.</p>
                </div>
            </div>
        </div>

        <div class="relative z-10 text-[11px] text-zinc-600">
            Registrandoti dichiari di accettare le linee guida della community basate sul rispetto reciproco e sull'onestà intellettuale.
        </div>
    </div>

    <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 sm:p-12 md:p-16 bg-[#0c0c0e]">
        
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-white sm:text-3xl">
                    Inizia il tuo percorso
                </h2>
                <p class="text-sm text-zinc-500 mt-2">
                    Crea le tue credenziali d'accesso.
                </p>
            </div>

            <form wire:submit="register" class="space-y-5">
                <div>
                    <x-input-label for="name" :value="__('Nome')" class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2" />
                    <x-text-input 
                        wire:model="name" 
                        id="name" 
                        class="block w-full bg-zinc-950/60 border border-zinc-850 text-white rounded-xl px-4 py-3.5 focus:border-[#D4FF3A] focus:ring-1 focus:ring-[#D4FF3A] transition-colors placeholder:text-zinc-700" 
                        type="text" 
                        name="name" 
                        required 
                        autofocus 
                        autocomplete="name" 
                        placeholder="Come vuoi farti chiamare?" 
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs font-medium" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2" />
                    <x-text-input 
                        wire:model="email" 
                        id="email" 
                        class="block w-full bg-zinc-950/60 border border-zinc-850 text-white rounded-xl px-4 py-3.5 focus:border-[#D4FF3A] focus:ring-1 focus:ring-[#D4FF3A] transition-colors placeholder:text-zinc-700" 
                        type="email" 
                        name="email" 
                        required 
                        autocomplete="username" 
                        placeholder="nome@esempio.com" 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-medium" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2" />
                    <x-text-input 
                        wire:model="password" 
                        id="password" 
                        class="block w-full bg-zinc-950/60 border border-zinc-850 text-white rounded-xl px-4 py-3.5 focus:border-[#D4FF3A] focus:ring-1 focus:ring-[#D4FF3A] transition-colors placeholder:text-zinc-700" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="new-password" 
                        placeholder="Scegli una password forte" 
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-medium" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Conferma Password')" class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2" />
                    <x-text-input 
                        wire:model="password_confirmation" 
                        id="password_confirmation" 
                        class="block w-full bg-zinc-950/60 border border-zinc-850 text-white rounded-xl px-4 py-3.5 focus:border-[#D4FF3A] focus:ring-1 focus:ring-[#D4FF3A] transition-colors placeholder:text-zinc-700" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password" 
                        placeholder="Ripeti la password" 
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs font-medium" />
                </div>

                <div class="pt-3 flex flex-col gap-3">
                    <button type="submit" class="w-full bg-[#D4FF3A] hover:bg-[#c2eb2b] text-black font-extrabold text-sm py-3.5 px-4 rounded-xl transition-all duration-200 shadow-[0_0_20px_rgba(212,255,58,0.1)] flex justify-center items-center gap-2 transform active:scale-[0.98]">
                        {{ __('Crea Account') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    
                    <a href="{{ route('login') }}" class="w-full text-center py-3.5 px-4 bg-transparent hover:bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white font-semibold rounded-xl transition-colors text-sm" wire:navigate>
                        {{ __('Hai già un account? Accedi') }}
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>