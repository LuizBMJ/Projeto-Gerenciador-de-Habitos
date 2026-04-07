<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">

        {{-- NAVBAR --}}
        <x-main-content.navbar />

        <div class="flex flex-col gap-4">

            <x-main-content.title>
                Configurar Hábitos
            </x-main-content.title>

            <div id="search-wrapper" class="relative w-full hidden">
                <div class="flex items-center gap-2 w-full">
                    <div class="relative flex-1">
                        <input
                            type="text"
                            id="habit-search"
                            placeholder="Buscar hábito..."
                            class="w-full bg-white
                                text-sm sm:text-base
                                px-3 py-2 sm:px-4 sm:py-2.5
                                pl-9 sm:pl-10
                                habit-shadow
                                focus:outline-none focus:ring-2 focus:ring-green-400
                                transition"
                            oninput="filterHabits(this.value)"
                            data-list="habit-list"
                        >

                        <svg
                            class="absolute left-3 top-1/2 -translate-y-1/2
                                w-4 h-4 sm:w-5 sm:h-5
                                text-gray-400 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 256 256">

                            <path d="M229.66,218.34l-50.07-50.07a88,88,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.31ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/>
                        </svg>
                    </div>

                    <button
                        id="delete-selected-btn"
                        onclick="deleteSelectedHabits()"
                        class="hidden items-center justify-center gap-2
                            bg-red-500 text-white
                            px-2.5 py-2 sm:px-3 sm:py-2
                            habit-shadow-lg
                            hover:opacity-80
                            cursor-pointer
                            whitespace-nowrap
                            transition">

                        <x-icons.trash class="w-4 h-4 sm:w-5 sm:h-5"/>

                        <span class="hidden md:inline">
                            Deletar selecionados
                        </span>
                    </button>
                </div>
                {{-- SELECT ALL --}}
                <label class="flex items-center gap-2 mt-2 cursor-pointer w-fit select-none text-sm text-gray-600">
                    <input type="checkbox" id="select-all-checkbox" class="w-4 h-4 cursor-pointer">
                    Selecionar todos
                </label>
            </div>
            <ul class="flex flex-col gap-2 mt-2" id="habit-list"
                data-view="settings"
                data-offset="0"
                data-paginate-url="{{ route('dashboard.habits.paginate') }}"
                data-toggle-url="{{ url('/dashboard/habits') }}"
                data-edit-url="{{ url('/dashboard/habits') }}"
                data-delete-url="{{ url('/dashboard/habits') }}">
            </ul>
            <div class="flex flex-row gap-5 items-center justify-center flex-wrap">
                <p id="no-results" class="hidden text-gray-400 text-sm mt-2">
                    Nenhum hábito encontrado.
                </p>
                <div class="flex flex-row gap-5 mt-2">
                    <button id="load-more" class="hidden p-2 habit-shadow-lg bg-white habit-btn w-fit text-sm sm:text-lg">
                        Carregar mais
                    </button>
                    <button id="load-all-btn" class="hidden p-2 habit-shadow-lg bg-white habit-btn w-fit text-sm sm:text-lg">
                        Carregar tudo
                    </button>
                </div>
            </div>
        </div>

    </main>
</x-layout>