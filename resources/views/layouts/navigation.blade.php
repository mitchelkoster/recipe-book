<!-- Logo -->
<a href="{{ url("/") }}" class="px-2 py-1 text-white font-semibold rounded flex items-center">
    <img class="h-8" src="{{ asset('img/logo.svg') }}" alt="Recipes Logo">
</a>

<!-- Navigation links -->
<nav class="flex w-full justify-between text-lg">
    <div class="flex">
        <a href="{{ url("/") }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">Latest Recipes</a>
        <a href="{{ url("/recipes") }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">All Recipes</a>
    </div>

    <!-- Utility links -->
    <div class="flex">
        @auth
            <a href="{{ route('dashboard') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">{{ __('Dashboard') }}</a>
            <a href="{{ route('logout') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">{{ __('Logout') }}</a>
        @else
            <a href="{{ route('login') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">{{ __('Login') }}</a>
            <a href="{{ route('register') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">{{ __('Register') }}</a>
        @endauth
    </div>
</nav>
