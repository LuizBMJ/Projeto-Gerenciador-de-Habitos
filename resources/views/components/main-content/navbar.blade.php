{{-- 
    NAVBAR - Dashboard page navigation tabs
    Links to: Hoje (Today), Histórico (History), Calendário (Calendar), Gerir (Manage)
    The Route::is() checks which page we're on and applies active styling
--}}
<div class="relative w-full mb-4 -mx-1 px-1">
    <div class="flex justify-center overflow-x-auto pb-2 scrollbar-none scroll-smooth">
        <nav class="flex gap-1.5 md:gap-2 p-1.5 md:p-2 bg-surface/40 backdrop-blur-md border border-border-glass rounded-xl md:rounded-2xl w-max min-w-min shadow-sm">
        
        {{-- Link to dashboard (today's habits) --}}
        <a href="{{ route('dashboard.habits.index') }}"
            class="px-4 py-2.5 md:px-4 md:py-2 rounded-lg md:rounded-xl text-[0.875rem] md:text-[0.95rem] font-semibold transition-all duration-300 whitespace-nowrap {{ Route::is('dashboard.habits.index') ? 'bg-surface-solid text-brand-blue shadow-[0_4px_12px_rgba(94,92,230,0.15)] scale-[1.02]' : 'text-text-secondary hover:text-text-primary hover:bg-surface/50' }}">
            Hoje
        </a>

        {{-- Link to history page --}}
        <a href="{{ route('dashboard.habits.history.index') }}"
            class="px-4 py-2.5 md:px-4 md:py-2 rounded-lg md:rounded-xl text-[0.875rem] md:text-[0.95rem] font-semibold transition-all duration-300 whitespace-nowrap {{ Route::is('dashboard.habits.history.index') ? 'bg-surface-solid text-brand-blue shadow-[0_4px_12px_rgba(94,92,230,0.15)] scale-[1.02]' : 'text-text-secondary hover:text-text-primary hover:bg-surface/50' }}">
            Histórico
        </a>

        {{-- Link to calendar page --}}
        <a href="{{ route('dashboard.habits.calendar.index') }}"
            class="px-4 py-2.5 md:px-4 md:py-2 rounded-lg md:rounded-xl text-[0.875rem] md:text-[0.95rem] font-semibold transition-all duration-300 whitespace-nowrap {{ Route::is('dashboard.habits.calendar.index') ? 'bg-surface-solid text-brand-blue shadow-[0_4px_12px_rgba(94,92,230,0.15)] scale-[1.02]' : 'text-text-secondary hover:text-text-primary hover:bg-surface/50' }}">
            Calendário
        </a>

        {{-- Link to settings/manage page (short label "Gerir" on mobile) --}}
        <a href="{{ route('dashboard.habits.settings') }}"
            class="px-4 py-2.5 md:px-4 md:py-2 rounded-lg md:rounded-xl text-[0.875rem] md:text-[0.95rem] font-semibold transition-all duration-300 whitespace-nowrap {{ Route::is('dashboard.habits.settings') ? 'bg-surface-solid text-brand-blue shadow-[0_4px_12px_rgba(94,92,230,0.15)] scale-[1.02]' : 'text-text-secondary hover:text-text-primary hover:bg-surface/50' }}">
            <span class="hidden md:block">Gerenciar Hábitos</span>
            <span class="md:hidden">Gerir</span>
        </a>
        </nav>
    </div>
</div>