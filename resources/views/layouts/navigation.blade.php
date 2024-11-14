<!-- Logo -->
<a href="{{ url("/") }}" class="px-2 py-1 text-white font-semibold rounded flex items-center">
    <img class="h-8 w-8" src="{{ asset('img/logo.svg') }}" alt="Recipes Logo">
</a>

<!-- Navigation links -->
<nav class="flex w-full justify-between text-lg">
    <!-- Main Menu -->
    <div class="hidden w-full md:flex md:items-center md:justify-between" id="navbar">
        <div class="flex">
            <a href="{{ url("/") }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('Latest') }}</a>
            <a href="{{ url("/recipes") }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('All') }}</a>
            <a href="{{ url("/tags/search") }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('Search') }}</a>
        </div>

        <!-- Utility links -->
        <div class="flex">
            @auth
                <a href="{{ url("/recipes/create") }}" class="p-3"><x-button>{{ __('Add Recipe') }}</x-button></a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('Logout') }}</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('Register') }}</a>
            @endauth
        </div>
    </div>

    <!-- Hamburger icon (collapsable menu) -->
    <button id="menu-toggle" class="p-3 ml-auto sm:hidden text-green-600 hover:text-green-400">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
</nav>

<!-- JavaScript for Toggling the Menu -->
<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('navbar').classList.toggle('hidden');
    });
</script>
