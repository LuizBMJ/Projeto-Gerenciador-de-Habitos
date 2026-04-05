<x-layout>
    <main class="max-w-5xl mx-auto py-10 px-4 min-h-[80vh] w-full" >
        <h1 class="font-bold text-2xl text-center ">
            Cadastrar novo Hábito
        </h1>

        <section class="habit-shadow-lg bg-white max-w-[600px] mx-auto p-10 pb-6 mt-4" >

            <form action="{{ route('dashboard.habits.store') }}" method="POST">
                @csrf

                <div class="flex flex-col gap-2 mb-4">
                    <label for="name" class="text-xl font-bold">
                        Nome do hábito
                    </label>

                    <input 
                    type="text" 
                    name="name"    
                    placeholder="Ex: Ler 10 páginas"
                    class="bg-white habit-shadow p-2 @error('name') border-red-500 @enderror"
                    >

                    @error('name') 
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button 
                    type="submit"
                    class="bg-habit-orange habit-btn habit-shadow-lg p-2 mt-2 w-full"
                >
                    Cadastrar Hábito
                </button>
                
            </form>
        </section>
    </main>
</x-layout>