<!-- Logo -->
<a href="{{ url("/") }}" class="px-2 py-1 text-white font-semibold rounded flex items-center">
    <img class="h-8 w-8" src="{{ asset('img/logo.svg') }}" alt="Recipes Logo">
</a>

<!-- Navigation links -->
<nav class="flex w-full justify-between text-lg">
    <div class="flex">
        <a href="{{ url("/") }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('Latest') }}</a>
        <a href="{{ url("/recipes") }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('All') }}</a>
    </div>

    <!-- Utility links -->
    <div class="flex">
        @auth
            <a href="{{ url("/recipes/create") }}" class="p-3"><x-button>{{ __('Add Recipe') }}</x-button></a>
            <a href="{{ route('dashboard') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('Dashboard') }}</a>

            {{-- Logout form --}}
            <form method="POST" action="{{ route('logout') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">
                @csrf
                <button type="submit">{{ __('Logout') }}</button>
              </form>
        @else
            <a href="{{ route('login') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('Login') }}</a>
            <a href="{{ route('register') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-1">{{ __('Register') }}</a>
        @endauth
    </div>
</nav>
