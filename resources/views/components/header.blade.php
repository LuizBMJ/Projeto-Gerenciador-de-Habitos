{{-- 
    HEADER - Site header with logo and navigation
    Shows: Logo, Menu (Login/Register or name/Logout), Theme toggle
    On mobile: Hamburger menu button
--}}
<header class="bg-surface/60 backdrop-blur-xl border-b border-border-glass sticky top-0 z-[100] shadow-sm transition-all duration-300">
    <div class="max-w-[960px] mx-auto px-5 h-16 flex items-center justify-between gap-4">

        {{-- LOGO (links to dashboard if logged in, home if not) --}}
        <a href="{{ auth()->check() ? route('dashboard.habits.index') : route('site.index') }}" class="flex items-center text-none shrink-0 group transition-transform active:scale-95">
            <img src="{{ asset('images/Habity-Logo.png') }}" alt="Habitly Logo" class="w-10 h-10 object-contain group-hover:rotate-6 transition-transform">
            <span class="text-[1rem] font-bold text-text-primary tracking-tight ml-1">Habitly</span>
        </a>

        {{-- DESKTOP NAV (hidden on mobile) --}}
        <nav class="hidden sm:flex items-center gap-3">
            <x-header-content.menu />
            <x-header-content.themetoggle />
        </nav>

        {{-- MOBILE MENU BUTTON (hidden on desktop) --}}
        <div class="relative sm:hidden">
            <button
                class="flex items-center justify-center w-12 h-12 rounded-xl border border-border-glass bg-surface/40 backdrop-blur-md cursor-pointer text-text-secondary transition-all duration-200 hover:bg-surface-secondary hover:scale-105 active:scale-95 shadow-sm shrink-0 outline-none"
                onclick="toggleMobileMenu()"
                aria-label="Abrir menu"
            >
                <x-icons.menu class="w-6 h-6" />
            </button>

            {{-- Mobile dropdown menu (rendered here) --}}
            <x-header-content.menu-hamburguer />
        </div>

    </div>
</header>

{{-- 
    Mobile menu JavaScript 
    Toggles open/closed class when hamburger is clicked
--}}
<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('open');
        if (menu.classList.contains('open')) {
            menu.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
            menu.classList.remove('opacity-0', '-translate-y-2', 'pointer-events-none', 'scale-95');
        } else {
            menu.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
            menu.classList.add('opacity-0', '-translate-y-2', 'pointer-events-none', 'scale-95');
        }
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('mobileMenu');
        if (!menu) return;
        
        const isToggleBtn = e.target.closest('button[aria-label="Abrir menu"]');
        const isThemeToggle = e.target.closest('#theme-toggle-mobile');
        
        // Prevent closing when clicking theme toggle
        if (isThemeToggle) {
            e.stopPropagation();
            return;
        }
        
        // Close menu if clicking outside it
        if (!menu.contains(e.target) && !isToggleBtn) {
            menu.classList.remove('open', 'opacity-100', 'translate-y-0', 'pointer-events-auto');
            menu.classList.add('opacity-0', '-translate-y-2', 'pointer-events-none', 'scale-95');
        }
    });
</script>