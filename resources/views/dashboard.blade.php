<x-layout>
    <main class="flex-1 py-8 px-5">
        <div class="w-full max-w-5xl mx-auto">

            {{-- NAVBAR TABS --}}
            <x-main-content.navbar />

            {{-- HEADER ROW --}}
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <x-main-content.title>
                        {{ \Carbon\Carbon::now()->locale('pt_BR')->translatedFormat('l, d \d\e F') }}
                    </x-main-content.title>
                </div>


            </div>

            {{-- SEARCH + SELECT ALL --}}
            <div id="search-wrapper" class="hidden flex flex-col gap-2.5 mb-4">
                <div class="flex items-center gap-2 w-full">
                    <div id="search-input-wrapper" class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-text-muted pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M229.66,218.34l-50.07-50.07a88,88,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.31ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z" />
                        </svg>
                        <input type="text" id="habit-search" placeholder="Buscar hábito..."
                            class="w-full bg-surface/60 backdrop-blur-md border border-border-glass rounded-xl px-4 py-2.5 pl-9 text-[0.95rem] text-text-primary outline-none transition-all duration-300 shadow-sm hover:bg-surface/80 hover:border-border focus:bg-surface focus:border-brand-blue focus:ring-[3px] focus:ring-brand-blue/20 placeholder:text-text-muted"
                            oninput="filterHabits(this.value)" data-list="habit-list">
                    </div>

                    <a href="{{ route('dashboard.habits.create') }}"
                        class="inline-flex items-center justify-center gap-1.5 font-medium text-sm px-4 py-3 rounded-xl transition-all duration-200 whitespace-nowrap bg-brand-blue text-white shadow-sm hover:bg-brand-blue-hover hover:shadow-md active:scale-95 outline-none">
                        <span class="hidden md:inline">+ Adicionar</span>
                        <span class="inline md:hidden">+</span>
                    </a>
                </div>

                <label id="select-all-wrapper"
                    class="flex items-center gap-2 cursor-pointer text-[0.84rem] text-text-secondary select-none w-max group">
                    <input type="checkbox" id="select-all-checkbox"
                        class="w-4 h-4 cursor-pointer accent-brand-blue transition-transform group-hover:scale-110">
                    Marcar todos
                </label>
            </div>

            {{-- HABIT LIST --}}
            <ul class="flex flex-col gap-2 w-full list-none p-0 m-0" id="habit-list" data-view="dashboard"
                data-offset="0" data-paginate-url="{{ route('dashboard.habits.paginate') }}"
                data-toggle-url="{{ url('/dashboard/habits') }}" data-edit-url="{{ url('/dashboard/habits') }}"
                data-delete-url="{{ url('/dashboard/habits') }}"></ul>

            <div class="flex items-center justify-center gap-3 flex-wrap mt-6">
                <p id="no-results" class="hidden text-[0.875rem] text-text-muted">
                    Nenhum hábito encontrado.
                </p>

                <button id="load-more"
                    class="hidden hover:cursor-pointer inline-flex items-center justify-center gap-1.5 font-medium text-sm px-4 py-2.5 rounded-xl transition-all duration-200 whitespace-nowrap bg-surface/50 backdrop-blur-sm text-text-secondary border border-border-glass hover:bg-surface/80 hover:text-text-primary active:scale-95 shadow-sm">
                    Carregar mais
                </button>

                <button id="load-all-btn"
                    class="hidden hover:cursor-pointer inline-flex items-center justify-center gap-1.5 font-medium text-sm px-4 py-2.5 rounded-xl transition-all duration-200 whitespace-nowrap bg-surface/50 backdrop-blur-sm text-text-secondary border border-border-glass hover:bg-surface/80 hover:text-text-primary active:scale-95 shadow-sm">
                    Carregar tudo
                </button>

            </div>

        </div>
    </main>
</x-layout>