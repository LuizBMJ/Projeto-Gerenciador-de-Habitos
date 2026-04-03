<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">

        {{-- NAVBAR --}}
        <x-navbar />

        <x-title>Histórico</x-title>

        {{-- YEAR SELECTION --}}
        @if (!empty($availableYears))
            <div class="my-4 flex flex-wrap gap-2">
                @foreach ($availableYears as $year)
                    <a href="{{ route('habits.history', $year) }}"
                        class="habit-btn habit-shadow p-2 inline-block {{ $selectedYear === $year ? 'bg-habit-orange text-white' : 'bg-white' }}">
                        {{ $year }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- CONTRIBUTION GRID --}}
        @if ($totalHabits === 0)
            <p>Você ainda não cadastrou nenhum hábito.</p>
        @elseif ($logCounts->isEmpty())
            <p class="text-gray-500">Nenhum hábito concluído em {{ $selectedYear }}.</p>
        @else
            <x-contribution
                :weeks="$weeks"
                :logCounts="$logCounts"
                :maxCount="$maxCount"
                :year="$selectedYear"
            />
        @endif

    </main>
</x-layout>