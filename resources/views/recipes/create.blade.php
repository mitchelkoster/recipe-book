<x-guest-layout>
    <div class="max-w-6xl mx-auto mt-6 px-6 py-4 sm:px-6 lg:px-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="text-2xl text-gray-800 mb-2"> {{ __('Add new recipe') }}</h1>
        <p class="mt-2 text-gray-600 mb-8">{{ __('Create a new recipe by easily adding ingredients from our database, separate it out in portions and steps.') }}</p>

        <!-- Handed down to VueJS -->
        <div id="app">
            <app></app>
        </div>
    </div>
</x-guest-layout>
