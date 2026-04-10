<div class="relative w-full mb-4">
    <div class="flex justify-center overflow-x-auto pb-2 scrollbar-none scroll-smooth">
        <nav class="flex gap-1 sm:gap-1.5 p-1 sm:p-1.5 bg-surface/40 backdrop-blur-md border border-border-glass rounded-2xl w-max min-w-min shadow-sm">
        <a href="{{ route('dashboard.habits.index') }}"
            class="px-4 py-2 rounded-xl text-[0.95rem] font-semibold transition-all duration-300 whitespace-nowrap {{ Route::is('dashboard.habits.index') ? 'bg-surface-solid text-brand-blue shadow-[0_4px_12px_rgba(94,92,230,0.15)] scale-[1.02]' : 'text-text-secondary hover:text-text-primary hover:bg-surface/50' }}">
            Hoje
        </a>

        <a href="{{ route('dashboard.habits.history.index') }}"
            class="px-4 py-2 rounded-xl text-[0.95rem] font-semibold transition-all duration-300 whitespace-nowrap {{ Route::is('dashboard.habits.history.index') ? 'bg-surface-solid text-brand-blue shadow-[0_4px_12px_rgba(94,92,230,0.15)] scale-[1.02]' : 'text-text-secondary hover:text-text-primary hover:bg-surface/50' }}">
            Histórico
        </a>

        <a href="{{ route('dashboard.habits.calendar.index') }}"
            class="px-4 py-2 rounded-xl text-[0.95rem] font-semibold transition-all duration-300 whitespace-nowrap {{ Route::is('dashboard.habits.calendar.index') ? 'bg-surface-solid text-brand-blue shadow-[0_4px_12px_rgba(94,92,230,0.15)] scale-[1.02]' : 'text-text-secondary hover:text-text-primary hover:bg-surface/50' }}">
            Calendário
        </a>

        <a href="{{ route('dashboard.habits.settings') }}"
            class="px-4 py-2 rounded-xl text-[0.95rem] font-semibold transition-all duration-300 whitespace-nowrap {{ Route::is('dashboard.habits.settings') ? 'bg-surface-solid text-brand-blue shadow-[0_4px_12px_rgba(94,92,230,0.15)] scale-[1.02]' : 'text-text-secondary hover:text-text-primary hover:bg-surface/50' }}">
            <span class="hidden sm:block">Gerenciar Hábitos</span>
            <span class="block sm:hidden">Gerenciar</span>
        </a>
    </nav>
</div>