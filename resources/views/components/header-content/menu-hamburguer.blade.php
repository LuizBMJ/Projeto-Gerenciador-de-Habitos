<div id="mobileMenu" class="absolute right-0 top-[calc(100%+0.5rem)] bg-surface/80 backdrop-blur-2xl border border-border-glass rounded-2xl p-3 flex flex-col gap-1.5 min-w-[200px] shadow-[0_12px_40px_rgba(0,0,0,0.12)] z-[200] opacity-0 -translate-y-1.5 scale-95 pointer-events-none transition-all duration-300 origin-top-right">

    @guest
        <a href="{{ route('site.login') }}" class="inline-flex items-center justify-center gap-1.5 w-full font-medium text-[0.9rem] leading-none px-4.5 py-2.5 rounded-xl transition-all duration-200 whitespace-nowrap bg-brand-blue text-white shadow-[0_2px_4px_rgba(0,113,227,0.2)] hover:bg-brand-blue-hover hover:shadow-[0_4px_8px_rgba(0,113,227,0.3)]">
            Login
        </a>
        <a href="{{ route('site.register') }}" class="block w-full text-left px-3 py-2 rounded-lg text-[0.88rem] font-medium text-text-primary bg-transparent border-none cursor-pointer transition-colors duration-150 hover:bg-surface-secondary">
            Registrar
        </a>
    @endguest

    @auth
        <span class="block px-3 py-2 text-[0.82rem] text-text-muted">
            {{ auth()->user()->name }}
        </span>
        <hr class="border-t border-border my-1">
        <form action="{{ route('dashboard.logout') }}" method="POST">
            @csrf
            <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-[0.88rem] font-medium text-text-primary bg-transparent border-none cursor-pointer transition-colors duration-150 hover:bg-surface-secondary">Sair</button>
        </form>
    @endauth

    <hr class="border-t border-border my-1">
    <a href="https://github.com/LuizBMJ/Projeto-Gerenciador-de-Habitos" target="_blank" class="block w-full text-left px-3 py-2 rounded-lg text-[0.88rem] font-medium text-text-primary bg-transparent border-none cursor-pointer transition-colors duration-150 hover:bg-surface-secondary">
        GitHub
    </a>

</div>