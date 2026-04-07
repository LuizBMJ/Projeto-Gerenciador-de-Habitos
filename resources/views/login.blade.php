<x-layout>
    <main class="max-w-5xl mx-auto py-8 px-4 min-h-[80vh] w-full flex flex-col items-center justify-center">

        <section class="bg-white w-full max-w-md mx-auto px-6 py-8 sm:p-10 mt-4 habit-shadow-lg">

            <h1 class="font-bold text-2xl sm:text-3xl">
                Faça Login
            </h1>

            <p>
                Insira seus dados para acessar.
            </p>

            <hr class="pb-4">

            <form 
                action="{{ route('auth.login') }}" 
                method="POST" 
                class="flex flex-col">

                @csrf

                <!-- EMAIL -->
                <div class="flex flex-col gap-2 mb-4">
                    <label for="email">
                        Email
                    </label>

                    <input 
                        type="email" 
                        name="email"    
                        placeholder="seu@email.com"
                        autocomplete="email"
                        value="{{ old('email') }}"
                        class="w-full bg-white p-2 habit-shadow @error('email') border-red-500 @enderror"
                    >

                    <p class="text-red-500 text-sm">
                        @error('email') 
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <!-- PASSWORD -->
                <div class="flex flex-col gap-2 mb-4">
                    <label for="password">
                        Senha
                    </label>

                    <div class="relative">
                        <input 
                            id="password"
                            type="password" 
                            name="password"    
                            placeholder="senha"
                            autocomplete="current-password"
                            class="w-full bg-white p-2 pr-10 habit-shadow @error('password') border-red-500 @enderror"
                        >

                        <button 
                            type="button"
                            onclick="togglePassword('password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer"
                        >
                            <span class="eye-open">
                                <x-icons.eye />
                            </span>

                            <span class="eye-closed hidden">
                                <x-icons.eyeclosed />
                            </span>
                        </button>
                    </div>

                    <p class="text-red-500 text-sm">
                        @error('password') 
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <!-- BUTTON -->
                <button 
                    type="submit"
                    class="w-full p-2 bg-habit-orange habit-shadow-lg habit-btn"
                >
                    Entrar
                </button>

                <!-- LINK -->
                <p class="text-center mt-2">
                    Ainda não tem uma conta?
                    <a href="{{ route('site.register') }}" class="underline hover:opacity-50 transtition">
                        Registre-se
                    </a>
                </p>

            </form>

            <div>
                <!-- Separador -->
                <div class="flex items-center gap-3 my-4">
                    <hr class="flex-1 border-gray-300">
                    <span class="text-sm text-gray-400">ou</span>
                    <hr class="flex-1 border-gray-300">
                </div>
                <!-- Botão Google -->
                <a
                    href="{{ route('auth.google.redirect') }}"
                    class="w-full flex items-center justify-center gap-3 p-2 border border-gray-300 habit-shadow hover:bg-gray-50 transition"
                >
                    <!-- Logo Google SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                        <path fill="none" d="M0 0h48v48H0z"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Entrar com Google</span>
                </a>
            </div>
        </section>
    </main>
</x-layout>