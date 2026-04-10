@auth
    <div class="flex items-center gap-3">
        <span class="text-[0.88rem] text-text-secondary hidden md:inline">
            Olá, <strong class="text-text-primary font-bold">{{ auth()->user()->name }}</strong>
        </span>
        <form action="{{ route('dashboard.logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="inline-flex items-center justify-center gap-2 font-bold text-[0.82rem] px-4 py-2 rounded-xl transition-all duration-300 bg-transparent text-text-secondary border border-border-glass hover:bg-surface-secondary hover:text-text-primary hover:scale-105 active:scale-95 shadow-sm cursor-pointer outline-none">Sair</button>
        </form>
    </div>
@endauth

@guest
    <div class="flex items-center gap-2.5">
        <a href="{{ route('site.register') }}" class="inline-flex items-center justify-center gap-2 font-bold text-[0.82rem] px-4 py-2 rounded-xl transition-all duration-300 bg-transparent text-text-secondary border border-border-glass hover:bg-surface-secondary hover:text-text-primary hover:scale-105 active:scale-95 shadow-sm outline-none">Registre-se</a>
        <a href="{{ route('site.login') }}" class="inline-flex items-center justify-center gap-2 font-bold text-[0.82rem] px-4 py-2 rounded-xl transition-all duration-300 bg-brand-blue text-white shadow-lg shadow-brand-blue/20 hover:bg-brand-blue-hover hover:scale-105 active:scale-95 outline-none">Login</a>
    </div>
@endguest
    <button id="theme-toggle" class="inline-flex items-center justify-center p-2.5 w-10 h-10 text-text-secondary rounded-xl bg-transparent border border-transparent hover:bg-surface-secondary hover:text-brand-blue hover:scale-110 active:scale-90 transition-all duration-300 outline-none cursor-pointer" aria-label="Alterar tema">
        <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.485a1 1 0 10-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM5 11a1 1 0 100-2H4a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
        <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
    </button>
</a>