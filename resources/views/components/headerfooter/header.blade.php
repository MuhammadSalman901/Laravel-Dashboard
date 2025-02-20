<header class="bg-black font-sm font-bold bg-center fixed top-0 left-0 right-0 z-50">
    <div class="flex justify-between px-10 py-1">
        <img src="{{ Vite::asset('resources/images/logo_t.png') }}" class="h-12" alt="Gnome">
        @guest
        <a class="border rounded-xl px-7 pt-3 text-white font-sm rounded-xl border border-transparent hover:border-blue-800 hover:bg-purple-500 transition-colors duration-300 " href="{{ route('login') }}">Login</a>
        @endguest
        @auth
        <form method="post" action="/logout">
            @csrf
            <div class="flex justify-between">
                <a href="{{ route('profile') }}" class="cursor-pointer border rounded-xl px-7 py-2 text-white font-sm rounded-xl border border-transparent hover:border-blue-800 hover:bg-violet-700 transition-colors duration-300">
                    <h5 class="text-white">{{ Auth::user()->name }}</h5>
                </a>
                <button class="border rounded-xl px-7 py-2 text-white font-sm rounded-xl border border-transparent hover:border-blue-800 hover:bg-purple-500 transition-colors duration-300">Logout</button>
            </div>
        </form>
        @endauth
    </div>
</header>