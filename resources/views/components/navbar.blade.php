<div>
    <nav>
        <ul class="flex flex-wrap gap-x-4 gap-y-2 items-center justify-center text-sm sm:text-xl">

            <li>
                <a href="{{ route('habits.index') }}"
                    class="{{ Route::is('habits.index') ? 'font-bold underline' : '' }} border-r-2 border-habit-orange pr-4 hover:underline whitespace-nowrap">
                    Hoje
                </a>
            </li>

            <li>
                <a href="{{ route('habits.history') }}"
                    class="{{ Route::is('habits.history') ? 'font-bold underline' : '' }} border-r-2 border-habit-orange pr-4 hover:underline whitespace-nowrap">
                    Histórico
                </a>
            </li>

            <li>
                <a href="{{ route('habits.calendar.index') }}"
                    class="{{ Route::is('habits.calendar.index') ? 'font-bold underline' : '' }} border-r-2 border-habit-orange pr-4 hover:underline whitespace-nowrap">
                    Calendário
                </a>
            </li>

            <li>
                <a href="{{ route('habits.settings') }}"
                    class="{{ Route::is('habits.settings') ? 'font-bold underline' : '' }} hover:underline whitespace-nowrap">
                    <span class="hidden sm:block">Gerenciar Hábitos</span>
                    <span class="block sm:hidden">Gerenciar</span>
                </a>
            </li>

        </ul>
    </nav>
</div>