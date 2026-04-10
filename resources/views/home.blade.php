<x-layout>
    <main class="flex flex-col items-center justify-center min-h-[75vh] w-full text-center px-6">
        <span class="inline-block px-3.5 py-1.5 rounded-full text-brand-blue bg-brand-blue/10 font-semibold text-[0.85rem] tracking-wide uppercase mb-6">✦ Gerenciador de hábitos</span>

        <h1 class="text-[3rem] sm:text-[4.5rem] font-black text-text-primary leading-[1.05] tracking-tight mb-5">
            Veja seus hábitos<br>
            <span class="bg-gradient-to-r from-brand-blue to-brand-blue-end bg-clip-text text-transparent">ganharem vida</span>
        </h1>

        <p class="text-[1.1rem] sm:text-[1.25rem] text-text-secondary max-w-2xl font-medium mb-10">
            Registre, acompanhe e construa uma rotina consistente com simplicidade.
        </p>

        <div class="flex gap-3 flex-wrap justify-center w-full">
            <a href="{{ route('site.register') }}" class="inline-flex items-center justify-center gap-1.5 font-medium text-[1rem] leading-none px-5 py-3 rounded-xl transition-all duration-200 whitespace-nowrap bg-brand-blue text-white shadow-[0_2px_4px_rgba(0,113,227,0.2)] hover:bg-brand-blue-hover hover:shadow-[0_4px_8px_rgba(0,113,227,0.3)]">
                Começar agora
            </a>
            <a href="{{ route('site.login') }}" class="inline-flex items-center justify-center gap-1.5 font-medium text-[1rem] leading-none px-5 py-3 rounded-xl transition-all duration-200 whitespace-nowrap bg-transparent text-text-secondary border border-border-strong hover:bg-surface-secondary hover:text-text-primary block text-center">
                Já tenho conta
            </a>
        </div>
    </main>
</x-layout>