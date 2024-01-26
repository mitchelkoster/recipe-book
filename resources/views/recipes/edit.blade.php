<x-guest-layout>
    <div class="max-w-6xl mx-auto bg-green-100 border-b-2 text-center border-green-500 text-green-700 p-4 mt-4 rounded" style="display: none;" id="alert" role="alert">
        <p><!-- Populated by Javascript --></p>
    </div>

    <div class="max-w-6xl mx-auto mt-6 px-6 py-4 sm:px-6 lg:px-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="text-2xl text-gray-800 mb-2"> {{ __('Edit Recipe') }}</h1>
        <p class="mt-2 text-gray-600 mb-8">{{ __('This page allows you to modify a recipe.') }}</p>

        <!-- Handed down to VueJS -->
        <div id="app">
            <edit-recipe apikey="{{ $apikey }}" original-recipe="{{ $recipe }}"></edit-recipe>
        </div>
    </div>
</x-guest-layout>
