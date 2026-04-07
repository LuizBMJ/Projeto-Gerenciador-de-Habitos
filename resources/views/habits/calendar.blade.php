<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">

        {{-- NAVBAR --}}
        <x-main-content.navbar />

        <x-main-content.title>
            Calendário
        </x-main-content.title>

        
        @if ($habits->count() >= 1)
            <p class="text-sm text-gray-500 mb-6 -mt-2">
                Selecione um hábito e clique em um dia para marcar ou desmarcar.
            </p>    
            @else
                <p class="mt-4">
                    Você ainda não cadastrou nenhum hábito.
                </p>
        @endif

        {{-- HABIT SELECTOR --}}
        <div class="mb-6">
            @if ($habits->count() >= 1)
                <div class="flex items-center justify-between gap-2 mb-2">

                    <p class="text-sm font-bold uppercase tracking-widest text-gray-400">
                        Filtrar por hábito
                    </p>

                    <button
                        type="button"
                        onclick="toggleHabitOrder()"
                        class="habit-btn habit-shadow p-2 rounded bg-gray-100 hover:bg-habit-orange hover:text-white transition-colors"
                        title="Alterar ordem"
                    >
                        <x-icons.filter />
                    </button>

                </div>
                
                <div class="flex flex-wrap gap-3 border-2 p-3 rounded bg-white habit-shadow-lg">

                    {{-- BUTTON ALL --}}
                    @if($habits->count() >= 2)
                        <button
                            type="button"
                            data-habit
                            data-all
                            onclick="selectHabit(null, this)"
                            class="habit-btn habit-shadow text-sm sm:text-normal
                                px-4 py-2
                                w-full sm:w-auto
                                bg-gray-100 hover:bg-habit-orange hover:text-white
                                transition-colors">
                            Todos
                        </button>
                    @endif

                    {{-- HABITS BUTTONS --}}
                    @foreach ($habits as $habit)
                        <button
                            type="button"
                            data-habit
                            data-id="{{ $habit->id }}"
                            data-name="{{ strtolower($habit->name) }}"
                            data-created="{{ $habit->created_at }}"
                            data-completed="{{ $habit->habitLogs->count() }}"
                            onclick="selectHabit({{ $habit->id }}, this)"
                            class="habit-btn habit-shadow text-sm sm:text-normal
                                px-4 py-2
                                flex-1 sm:flex-none
                                text-center
                                bg-gray-100 hover:bg-habit-orange hover:text-white
                                transition-colors">
                            {{ $habit->name }}
                        </button>
                    @endforeach

                </div>
            @endif
        </div>

        {{-- CALENDAR --}}
        <div class="bg-white habit-shadow-lg p-2 sm:p-6 w-full overflow-hidden">
            <div id="calendar" class="w-full"></div>
        </div>

    </main>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    @endpush

</x-layout>