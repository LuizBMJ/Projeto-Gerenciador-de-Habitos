<x-layout>
    <main class="flex-1 flex items-center justify-center p-8 sm:p-4 min-h-[calc(100vh-80px)]">

        <div class="w-full max-w-[420px] bg-surface p-7 sm:p-10 rounded-3xl border border-border flex flex-col shadow-[0_4px_32px_rgba(0,0,0,0.06)]">

            <h1 class="text-2xl font-bold text-text-primary tracking-[-0.02em] text-center mb-2">Bem-vindo de volta</h1>
            <p class="text-[0.95rem] text-text-secondary text-center mb-8">Insira seus dados para acessar sua conta.</p>

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                {{-- EMAIL --}}
                <div class="flex flex-col mb-4.5">
                    <label class="block text-[0.85rem] font-medium text-text-secondary mb-1.5 tracking-[0.01em]" for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="seu@email.com"
                        autocomplete="email"
                        value="{{ old('email') }}"
                        class="w-full bg-surface-input border border-border rounded-xl px-3.5 py-2.5 text-[0.95rem] text-text-primary outline-none transition-all duration-200 shadow-[inset_0_1px_2px_rgba(0,0,0,0.02)] hover:border-border-strong focus:bg-surface focus:border-brand-blue focus:ring-[3px] focus:ring-brand-blue/15 placeholder:text-text-muted @error('email') border-error focus:ring-error/15 @enderror"
                    >
                    @error('email')
                        <span class="text-[0.8rem] text-error mt-1.5 min-h-[1.1rem]">{{ $message }}</span>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="flex flex-col mb-4.5">
                    <label class="block text-[0.85rem] font-medium text-text-secondary mb-1.5 tracking-[0.01em]" for="password">Senha</label>
                    <div class="relative w-full">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            class="w-full bg-surface-input border border-border rounded-xl px-3.5 py-2.5 text-[0.95rem] text-text-primary outline-none transition-all duration-200 shadow-[inset_0_1px_2px_rgba(0,0,0,0.02)] hover:border-border-strong focus:bg-surface focus:border-brand-blue focus:ring-[3px] focus:ring-brand-blue/15 placeholder:text-text-muted @error('password') border-error focus:ring-error/15 @enderror"
                        >
                        <button
                            type="button"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-text-muted hover:text-text-primary p-1 bg-transparent border-none cursor-pointer flex items-center justify-center transition-colors"
                            onclick="togglePassword('password', this)"
                            tabindex="-1"
                        >
                            <span class="eye-open"><x-icons.eye /></span>
                            <span class="eye-closed hidden"><x-icons.eyeclosed /></span>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-[0.8rem] text-error mt-1.5 min-h-[1.1rem]">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full hover:cursor-pointer mt-1 inline-flex items-center justify-center gap-1.5 font-medium text-[1rem] leading-none px-5 py-3 rounded-xl transition-all duration-200 whitespace-nowrap bg-brand-blue text-white shadow-[0_2px_4px_rgba(0,113,227,0.2)] hover:bg-brand-blue-hover hover:shadow-[0_4px_8px_rgba(0,113,227,0.3)]">
                    Entrar
                </button>
            </form>

            <p class="text-center text-[0.9rem] text-text-secondary mt-6">
                Ainda não tem conta?
                <a href="{{ route('register.index') }}" class="font-medium text-brand-blue no-underline hover:underline">Registre-se</a>
            </p>

            <div class="flex items-center gap-4 my-6 text-[0.8rem] font-medium text-text-muted uppercase tracking-widest">
                <hr class="flex-1 border-t border-border"><span class="text-text-muted">ou</span><hr class="flex-1 border-t border-border">
            </div>

            <a href="{{ route('auth.google.redirect') }}" class="relative inline-flex items-center justify-center gap-3 w-full font-medium text-[0.95rem] px-5 py-3 rounded-xl bg-surface-secondary text-text-primary border border-border cursor-pointer transition-all duration-200 no-underline hover:bg-surface hover:shadow-sm hover:-translate-y-[1px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                </svg>
                Continuar com Google
            </a>

        </div>

    </main>
</x-layout>