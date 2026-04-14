<x-layout>
    <main class="flex-1 py-8 px-5">
        <div class="w-full max-w-5xl mx-auto">

            {{-- PAGE TABS (Hoje, Histórico, Calendário, Gerenciar) --}}
            <x-main-content.navbar />

            {{-- DATE HEADER --}}
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <x-main-content.title>
                        {{-- Display today's date in Portuguese format (e.g., "terça-feira, 14 de abril") --}}
                        {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('l, d \d\e F') }}
                    </x-main-content.title>
                </div>
            </div>

            {{-- SEARCH INPUT AND ADD BUTTON --}}
            {{-- This wrapper is hidden by default, shown by JavaScript when there are habits --}}
            <div id="search-wrapper" class="hidden flex flex-col gap-3 mb-4">
                <div class="flex items-center gap-2 w-full">
                    {{-- Search input with search icon --}}
                    <div id="search-input-wrapper" class="relative flex-1">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-text-muted pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M229.66,218.34l-50.07-50.07a88,88,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.31ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z" />
                        </svg>
                        {{-- oninput calls JavaScript filter function, data-list connects to habit list --}}
                        <input type="text" id="habit-search" placeholder="Buscar hábito..."
                            class="w-full bg-surface/60 backdrop-blur-md border border-border-glass rounded-xl px-4 py-3 pl-10 text-[0.95rem] text-text-primary outline-none transition-all duration-300 shadow-sm hover:bg-surface/80 hover:border-border focus:bg-surface focus:border-brand-blue focus:ring-[3px] focus:ring-brand-blue/20 placeholder:text-text-muted"
                            oninput="filterHabits(this.value)" data-list="habit-list">
                    </div>

                    {{-- Add button - disabled when at 10 habit limit --}}
                    <a href="{{ $habitCount >= 10 ? 'javascript:void(0)' : route('dashboard.habits.create') }}"
                        @if($habitCount >= 10) title="Limite de 10 hábitos atingido" @endif
                        class="inline-flex items-center justify-center gap-2 font-semibold text-[0.95rem] px-5 py-3 rounded-xl transition-all duration-200 whitespace-nowrap {{ $habitCount >= 10 ? 'bg-text-muted cursor-not-allowed' : 'bg-brand-blue hover:bg-brand-blue-hover text-white active:scale-95 shadow-md hover:shadow-lg' }} outline-none">
                        <span class="hidden md:inline">+ Adicionar</span>
                        <span class="inline md:hidden text-lg">+</span>
                    </a>
                </div>

                {{-- "Select all" checkbox --}}
                <label id="select-all-wrapper"
                    class="flex items-center gap-2.5 cursor-pointer text-[0.875rem] text-text-secondary select-none w-max group">
                    <input type="checkbox" id="select-all-checkbox"
                        class="w-5 h-5 cursor-pointer accent-brand-blue transition-transform group-hover:scale-110">
                    Marcar todos
                </label>
            </div>

            {{-- HABIT LIST --}}
            {{-- data attributes pass URLs to JavaScript for API calls --}}
            <ul class="flex flex-col gap-2 w-full list-none p-0 m-0" id="habit-list" data-view="dashboard"
                data-offset="0" 
                data-paginate-url="{{ route('dashboard.habits.paginate') }}"
                data-toggle-url="{{ url('/dashboard/habits') }}" 
                data-edit-url="{{ url('/dashboard/habits') }}"
                data-delete-url="{{ url('/dashboard/habits') }}"></ul>

            {{-- EMPTY STATE MESSAGE --}}
            <div class="flex items-center justify-center gap-3 flex-wrap mt-6">
                <p id="no-results" class="hidden text-[0.875rem] text-text-muted">
                    Nenhum hábito encontrado.
                </p>
            </div>

        </div>
    </main>
</x-layout>