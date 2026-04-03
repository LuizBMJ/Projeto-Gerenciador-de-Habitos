<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">

        {{-- NAVBAR --}}
        <x-navbar />

        {{-- CONTENT --}}
        <div class="flex flex-col gap-4">

            <x-title>
                {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('l, d \d\e F') }}
            </x-title>

            {{-- SEARCH BAR --}}
            @if ($habits->count() >= 1)
                <div class="relative w-full">
                    <input
                        type="text"
                        id="habit-search"
                        placeholder="Buscar hábito..."
                        class="w-full bg-white p-2 pl-9 habit-shadow focus:outline-none"
                        oninput="filterHabits(this.value)"
                    >
                    <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M229.66,218.34l-50.07-50.07a88,88,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.31ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/>
                    </svg>
                </div>
            @endif

            {{-- HABIT LIST --}}
            <ul class="flex flex-col gap-2 w-full" id="habit-list">

                @forelse ($habits as $item)
                    <li class="habit-shadow-lg p-2 bg-[#FFDAAC] habit-item" data-name="{{ strtolower($item->name) }}">
                        <form
                            action="{{ route('habits.toggle', $item->id) }}"
                            method="POST"
                            class="flex gap-2 items-center"
                            id="form-{{ $item->id }}"
                        >
                            @csrf

                            <input
                                type="checkbox"
                                class="w-5 h-5"
                                {{ $item->wasCompletedToday() ? 'checked' : '' }}
                                onchange="document.getElementById('form-{{ $item->id }}').submit()"
                            >
                            <p class="font-bold text-lg">
                                {{ $item->name }}
                            </p>
                        </form>
                    </li>
                @empty
                    <p>Você ainda não cadastrou nenhum hábito.</p>
                @endforelse

            </ul>

            {{-- EMPTY SEARCH STATE --}}
            <p id="no-results" class="hidden text-gray-400 text-sm">
                Nenhum hábito encontrado.
            </p>

            <a href="{{ route('habits.create') }}" class="p-2 habit-shadow-lg bg-habit-orange habit-btn w-fit">
                + Adicionar
            </a>

        </div>
    </main>

    <script>
        function filterHabits(query) {
            const items = document.querySelectorAll('.habit-item');
            const noResults = document.getElementById('no-results');
            const search = query.toLowerCase().trim();
            let visible = 0;

            items.forEach(item => {
                const name = item.dataset.name;
                const matches = name.includes(search);
                item.classList.toggle('hidden', !matches);
                if (matches) visible++;
            });

            noResults.classList.toggle('hidden', visible > 0);
        }
    </script>

</x-layout>