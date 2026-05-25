<x-app-layout>
<div class="min-h-screen bg-[#0a0a0f] text-white pt-16">
    <div class="max-w-4xl mx-auto px-4 py-10">
        
        <h1 class="text-3xl font-black mb-6">Risultati per: <span class="text-[#e8ff47]">"{{ $query }}"</span></h1>

        @if($results->isEmpty())
            <div class="bg-[#111118] p-8 rounded-2xl text-center border border-[#1e1e2e]">
                <p class="text-zinc-500">Nessun dibattito trovato per questo significato.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($results as $debate)
                    <div class="bg-[#111118] border border-[#1e1e2e] p-6 rounded-2xl hover:border-zinc-700">
                        <h2 class="text-xl font-bold mb-2">{{ $debate->title }}</h2>
                        <p class="text-zinc-400 text-sm">{{ Str::limit($debate->message, 150) }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('dashboard') }}" class="mt-8 inline-block text-zinc-500 hover:text-white underline">Torna al feed</a>
    </div>
</div>
</x-app-layout>