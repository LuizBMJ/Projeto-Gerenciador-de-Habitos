<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full">
        
        <div class="w-full max-w-5xl">
            <h1 class="font-bold text-2xl text-center">
                Editar Hábito
            </h1>

            <section class="habit-shadow-lg bg-white max-w-[600px] mx-auto p-10 pb-6 mt-4 w-full">

                <form action="{{ route('dashboard.habits.update', $habit) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-2 mb-4">
                        <label for="name" class="text-xl font-bold">
                            Nome do hábito
                        </label>

                        <input 
                            type="text" 
                            name="name" 
                            placeholder="Ex: Ler 10 páginas"
                            class="bg-white habit-shadow p-2 w-full @error('name') border-red-500 @enderror"
                            value="{{ $habit->name }}"
                        >

                        @error('name')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-habit-orange habit-btn habit-shadow-lg p-2 mt-2 w-full">
                        Editar Hábito
                    </button>

                </form>
            </section>
        </div>

    </main>
</x-layout>