<x-layout>
    <main class="max-w-5xl mx-auto py-8 px-4 min-h-[80vh] w-full flex flex-col items-center justify-center">

        <section class="bg-white w-full max-w-md mx-auto px-6 py-8 sm:p-10 mt-4 habit-shadow-lg">

            <h1 class="font-bold text-2xl sm:text-3xl">
                Conta encontrada
            </h1>

            <p class="mt-1 mb-4 text-gray-600">
                Já existe uma conta com o e-mail abaixo. Digite sua senha para vincular 
                o login do Google — depois você poderá entrar das duas formas.
            </p>

            <hr class="pb-4">

            <form action="{{ route('auth.google.link.store') }}" method="POST" class="flex flex-col">
                @csrf

                <!-- EMAIL (somente leitura) -->
                <div class="flex flex-col gap-2 mb-4">
                    <label>E-mail</label>
                    <input 
                        type="email" 
                        value="{{ $email }}" 
                        disabled
                        class="w-full bg-gray-100 p-2 habit-shadow text-gray-500 cursor-not-allowed"
                    >
                </div>

                <!-- SENHA -->
                <div class="flex flex-col gap-2 mb-4">
                    <label for="password">Sua senha atual</label>

                    <div class="relative">
                        <input 
                            id="password"
                            type="password" 
                            name="password"    
                            placeholder="Digite sua senha"
                            class="w-full bg-white p-2 pr-10 habit-shadow @error('password') border-red-500 @enderror"
                        >
                        <button 
                            type="button"
                            onclick="togglePassword('password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer"
                        >
                            <span class="eye-open"><x-icons.eye /></span>
                            <span class="eye-closed hidden"><x-icons.eyeclosed /></span>
                        </button>
                    </div>

                    <p class="text-red-500 text-sm">
                        @error('password') {{ $message }} @enderror
                    </p>
                </div>

                <button 
                    type="submit"
                    class="w-full p-2 bg-habit-orange habit-shadow-lg habit-btn"
                >
                    Vincular e entrar
                </button>

                <p class="text-center mt-2 text-sm text-gray-500">
                    <a href="{{ route('site.login') }}" class="underline hover:opacity-50">
                        Voltar ao login
                    </a>
                </p>
            </form>

        </section>
    </main>
</x-layout>