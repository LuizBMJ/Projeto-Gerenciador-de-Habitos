<x-layout>
    <main class="flex-1 flex items-center justify-center p-8 sm:p-4 min-h-[calc(100vh-80px)] w-full">

        <section class="max-w-[420px] w-full bg-surface p-7 sm:p-10 rounded-3xl border border-border flex flex-col shadow-[0_4px_32px_rgba(0,0,0,0.06)]">

            <h1 class="text-2xl font-bold text-text-primary tracking-[-0.02em] text-center mb-2">
                Conta encontrada
            </h1>

            <p class="text-[0.95rem] text-text-secondary text-center mb-6">
                Já existe uma conta com o e-mail abaixo. Digite sua senha para vincular 
                o login do Google — depois você poderá entrar das duas formas.
            </p>

            <div class="flex items-center gap-4 mb-6 text-[0.8rem] font-medium text-text-muted uppercase tracking-widest">
                <hr class="flex-1 border-t border-border">
            </div>

            <form action="{{ route('auth.google.link.store') }}" method="POST" class="flex flex-col">
                @csrf

                <!-- EMAIL (somente leitura) -->
                <div class="flex flex-col mb-4.5">
                    <label class="block text-[0.85rem] font-medium text-text-secondary mb-1.5 tracking-[0.01em]">E-mail</label>
                    <input 
                        type="email" 
                        value="{{ $email }}" 
                        disabled
                        class="w-full bg-surface-secondary border border-border rounded-xl px-3.5 py-2.5 text-[0.95rem] text-text-muted outline-none shadow-[inset_0_1px_2px_rgba(0,0,0,0.02)] opacity-70 cursor-not-allowed"
                    >
                </div>

                <!-- SENHA -->
                <div class="flex flex-col mb-4.5">
                    <label for="password" class="block text-[0.85rem] font-medium text-text-secondary mb-1.5 tracking-[0.01em]">Sua senha atual</label>

                    <div class="relative w-full">
                        <input 
                            id="password"
                            type="password" 
                            name="password"    
                            placeholder="Digite sua senha"
                            class="w-full bg-surface-input border border-border rounded-xl px-3.5 py-2.5 text-[0.95rem] text-text-primary outline-none transition-all duration-200 shadow-[inset_0_1px_2px_rgba(0,0,0,0.02)] hover:border-border-strong focus:bg-surface focus:border-brand-blue focus:ring-[3px] focus:ring-brand-blue/15 placeholder:text-text-muted @error('password') border-error focus:ring-error/15 @enderror"
                        >
                        <button 
                            type="button"
                            onclick="togglePassword('password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-text-muted hover:text-text-primary p-1 bg-transparent border-none cursor-pointer flex items-center justify-center transition-colors"
                            tabindex="-1"
                        >
                            <span class="eye-open"><x-icons.eye /></span>
                            <span class="eye-closed hidden"><x-icons.eyeclosed /></span>
                        </button>
                    </div>

                    @error('password')
                        <p class="text-[0.8rem] text-error mt-1.5 min-h-[1.1rem]">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button 
                    type="submit"
                    class="w-full mt-1 inline-flex items-center justify-center gap-1.5 font-medium text-[1rem] leading-none px-5 py-3 rounded-xl transition-all duration-200 whitespace-nowrap bg-brand-blue text-white shadow-[0_2px_4px_rgba(0,113,227,0.2)] hover:bg-brand-blue-hover hover:shadow-[0_4px_8px_rgba(0,113,227,0.3)]"
                >
                    Vincular e entrar
                </button>

                <p class="text-center text-[0.9rem] text-text-secondary mt-6">
                    <a href="{{ route('login.index') }}" class="font-medium text-brand-blue no-underline hover:underline">
                        Voltar ao login
                    </a>
                </p>
            </form>

        </section>
    </main>
</x-layout>