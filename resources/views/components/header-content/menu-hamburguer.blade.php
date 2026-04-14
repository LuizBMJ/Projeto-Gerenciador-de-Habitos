<div id="mobileMenu" class="absolute right-0 top-[calc(100%+0.5rem)] bg-surface/80 backdrop-blur-2xl border border-border-glass rounded-2xl p-3 flex flex-col gap-1 min-w-[220px] shadow-[0_12px_40px_rgba(0,0,0,0.12)] z-[200] opacity-0 -translate-y-1.5 scale-95 pointer-events-none transition-all duration-300 origin-top-right">

    @guest
        <a href="{{ route('site.login') }}" class="inline-flex items-center justify-center gap-2 w-full font-semibold text-[1rem] leading-none px-5 py-3 rounded-xl transition-all duration-200 whitespace-nowrap bg-brand-blue text-white shadow-[0_2px_4px_rgba(0,113,227,0.2)] hover:bg-brand-blue-hover hover:shadow-[0_4px_8px_rgba(0,113,227,0.3)]">
            Login
        </a>
        <a href="{{ route('site.register') }}" class="block w-full text-left px-4 py-3 rounded-xl text-[1rem] font-semibold text-text-primary bg-transparent border-none cursor-pointer transition-colors duration-150 hover:bg-surface-secondary">
            Registrar
        </a>
    @endguest

    @auth
        <span class="block px-4 py-3 text-[0.95rem] text-text-muted font-medium">
            {{ auth()->user()->name }}
        </span>
        <hr class="border-t border-border my-1">
        <form action="{{ route('dashboard.logout') }}" method="POST">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-3 rounded-xl text-[1rem] font-semibold text-text-primary bg-transparent border-none cursor-pointer transition-colors duration-150 hover:bg-surface-secondary">Sair</button>
        </form>
    @endauth

    <hr class="border-t border-border my-1">
    <a href="https://github.com/LuizBMJ/Projeto-Gerenciador-de-Habitos" target="_blank" class="block w-full text-left px-4 py-3 rounded-xl text-[1rem] font-semibold text-text-primary bg-transparent border-none cursor-pointer transition-colors duration-150 hover:bg-surface-secondary">
        GitHub
    </a>

    <hr class="border-t border-border my-1">
    <button id="theme-toggle-mobile" class="block w-full text-left px-4 py-3 rounded-xl text-[1rem] font-semibold text-text-primary bg-transparent border-none cursor-pointer transition-colors duration-150 hover:bg-surface-secondary flex items-center gap-3" aria-label="Alterar tema">
        <span id="mobile-theme-label" class="flex-1">Modo escuro</span>
        <span id="mobile-theme-icon">
            <x-icons.moon class="w-5 h-5" />
        </span>
    </button>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileToggle = document.getElementById('theme-toggle-mobile');
        if (!mobileToggle) return;
        
        const mobileLabel = document.getElementById('mobile-theme-label');
        const mobileIcon = document.getElementById('mobile-theme-icon');
        
        function updateMobileThemeUI(isDark) {
            if (mobileLabel) {
                mobileLabel.textContent = isDark ? 'Modo claro' : 'Modo escuro';
            }
            if (mobileIcon) {
                mobileIcon.innerHTML = isDark 
                    ? '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.485a1 1 0 10-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM5 11a1 1 0 100-2H4a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>'
                    : '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>';
            }
        }
        
        function updateMobileLabel() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            updateMobileThemeUI(isDark);
            return isDark;
        }
        
        const isDark = updateMobileLabel();
        
        mobileToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const currentIsDark = document.documentElement.getAttribute('data-theme') === 'dark';
            const newTheme = currentIsDark ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateMobileThemeUI(newTheme === 'dark');
            window.dispatchEvent(new CustomEvent('theme-changed', { detail: { theme: newTheme } }));
        });
    });
</script>