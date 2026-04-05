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
        </section>
    </main>
</x-layout>