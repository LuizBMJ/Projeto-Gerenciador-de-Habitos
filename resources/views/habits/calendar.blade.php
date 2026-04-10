<x-layout>
    <main class="flex-1 py-8 px-5">
        <div class="w-full max-w-5xl mx-auto">

            {{-- NAVBAR --}}
            <x-main-content.navbar />


            {{-- HABIT SELECTOR --}}
            <div class="my-6">
                @if ($habits->count() >= 1)
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex flex-col gap-2">
                            <p class="text-[0.75rem] font-bold uppercase tracking-widest text-text-muted">
                                Filtrar por hábito
                            </p>

                            @if ($habits->count() >= 1)
                                <p class="text-[0.75rem] text-text-secondary mb-6 -mt-2">
                                    Selecione um hábito e clique em um dia para marcar ou desmarcar.
                                </p>    
                            @else
                                <p class="text-text-secondary mt-4">
                                    Você ainda não cadastrou nenhum hábito.
                                </p>
                            @endif
                        </div>
                        <button
                            type="button"
                            onclick="toggleHabitOrder()"
                            class="inline-flex hover:cursor-pointer items-center justify-center p-2 rounded-xl border border-transparent transition-all duration-200 bg-transparent text-text-secondary border-border-strong hover:bg-surface-secondary hover:text-text-primary"
                            title="Alterar ordem"
                        >
                            <x-icons.filter />
                        </button>
                    </div>
                    
                    <div class="relative w-full overflow-hidden">
                        <div class="flex overflow-x-auto pb-2 scrollbar-none scroll-smooth">
                            <div class="bg-surface/40 backdrop-blur-md border border-border-glass rounded-2xl p-3 sm:p-4 flex gap-2 sm:gap-2.5 w-max shadow-sm">
                                {{-- BUTTON ALL --}}
                                @if($habits->count() >= 2)
                                    <button
                                        type="button"
                                        data-habit
                                        data-all
                                        onclick="selectHabit(null, this)"
                                        class="inline-flex hover:cursor-pointer items-center justify-center gap-1.5 font-semibold text-xs sm:text-sm px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-full transition-all duration-300 whitespace-nowrap bg-transparent text-text-secondary border border-border-glass hover:bg-surface-secondary hover:text-text-primary active:scale-95 shadow-sm">
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
                                        class="inline-flex hover:cursor-pointer items-center justify-center gap-1.5 font-semibold text-xs sm:text-sm px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-full transition-all duration-300 whitespace-nowrap bg-transparent text-text-secondary border border-border-glass hover:bg-surface-secondary hover:text-text-primary active:scale-95 shadow-sm">
                                        {{ $habit->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- CALENDAR --}}
            @if ($habits->count() >= 1)
                <div class="bg-surface border border-border rounded-2xl p-5 sm:p-7 shadow-[0_4px_24px_rgba(0,0,0,0.04)] w-full overflow-hidden">
                    <div id="calendar" class="w-full"></div>
                </div>
            @else
                <p class="text-text-muted text-center">Você ainda não cadastrou nenhum hábito.</p>
            @endif

        </div>
    </main>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    @endpush

</x-layout>