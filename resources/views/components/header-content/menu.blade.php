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
        <x-icons.moon />
        <x-icons.sun />
    </button>
</a>