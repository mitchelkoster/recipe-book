<!-- Logo -->
<a href="{{ url("/home") }}" class="px-2 py-1 text-white font-semibold rounded flex items-center">
    <img class="h-8" src="/img/logo.svg" alt="Recipes Logo">
</a>

<!-- Navigation links -->
<nav class="flex w-full justify-between text-lg">
    <div class="flex">
        <a href="#" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">Latest Recipes</a>
    </div>

    <!-- Utility links -->
    <div class="flex">
        @auth
            <a href="{{ route('dashboard') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">Dashboard</a>
            <a href="{{ route('logout') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">Logout</a>
        @else
            <a href="{{ route('login') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">Login</a>
            <a href="{{ route('register') }}" class="mt-1 block p-3 text-green-600 font-semibold rounded hover:text-green-400 sm:mt-0 sm:ml-2">Register</a>
        @endauth
    </div>
</nav>
