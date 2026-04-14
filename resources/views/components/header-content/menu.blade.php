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
        <a href="{{ route('register.index') }}" class="inline-flex items-center justify-center gap-2 font-bold text-[0.82rem] px-4 py-2 rounded-xl transition-all duration-300 bg-transparent text-text-secondary border border-border-glass hover:bg-surface-secondary hover:text-text-primary hover:scale-105 active:scale-95 shadow-sm outline-none">Registre-se</a>
        <a href="{{ route('login.index') }}" class="inline-flex items-center justify-center gap-2 font-bold text-[0.82rem] px-4 py-2 rounded-xl transition-all duration-300 bg-brand-blue text-white shadow-lg shadow-brand-blue/20 hover:bg-brand-blue-hover hover:scale-105 active:scale-95 outline-none">Login</a>
    </div>
@endguest
