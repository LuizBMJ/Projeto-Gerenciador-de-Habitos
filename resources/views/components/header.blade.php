<header class="bg-white border-b-2 flex items-center justify-between p-4" >
    
    <div>
        Logo
    </div>

    <div>
        Github

        @auth
        <form class="inline" action="{{ route('auth.logout') }}" method="POST">
            @csrf

            <button 
                type="submit"
                class="bg-white border-2 p-2"
            >
                Sair
            </button>

        </form>
    @endauth

    @guest
        <a href="{{ route('site.login') }}" class="bg-white p-2 border-2">
            Login
        </a>
    @endguest
    </div>

    
</header>