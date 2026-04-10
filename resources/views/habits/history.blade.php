<x-layout>
    <main class="flex-1 py-8 px-5">
        <div class="w-full max-w-5xl mx-auto">

            {{-- NAVBAR --}}
            <x-main-content.navbar />

            <div class="mt-6">
                {{-- YEAR SELECTION --}}
                @if (!empty($availableYears))
                    <div class="flex flex-wrap gap-2 my-4 mb-6">
                        @foreach ($availableYears as $year)
                            <a href="{{ route('dashboard.habits.history.index', $year) }}"
                                class="inline-flex items-center justify-center gap-1.5 font-medium text-[0.9rem] leading-none px-4.5 py-2.5 rounded-xl border border-transparent cursor-pointer transition-all duration-200 no-underline whitespace-nowrap {{ $selectedYear === $year ? 'bg-brand-blue text-white shadow-[0_2px_4px_rgba(0,113,227,0.2)] hover:bg-brand-blue-hover hover:shadow-[0_4px_8px_rgba(0,113,227,0.3)]' : 'bg-transparent text-text-secondary border-border-strong hover:bg-surface-secondary hover:text-text-primary' }}">
                                {{ $year }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- CONTRIBUTION GRID --}}
                @if ($totalHabits === 0)
                    <p class="text-text-muted text-center">Você ainda não cadastrou nenhum hábito.</p>
                @elseif ($logCounts->isEmpty())
                    <p class="text-text-secondary">Nenhum hábito concluído em {{ $selectedYear }}.</p>
                @else
                    <div class="bg-surface border border-border rounded-2xl p-5 sm:p-7 shadow-[0_4px_24px_rgba(0,0,0,0.04)]">
                        <x-main-content.contribution
                            :weeks="$weeks"
                            :logCounts="$logCounts"
                            :maxCount="$maxCount"
                            :year="$selectedYear"
                        />
                    </div>
                @endif
            </div>
        </div>
    </main>
</x-layout>