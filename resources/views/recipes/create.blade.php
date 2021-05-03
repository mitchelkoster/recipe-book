<x-guest-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div id="app">
            <app></app>
        </div>
        <form method="POST" action="{{ route('register') }}">
        @csrf

            <!-- Title -->
            <div>
                <x-label for="title" :value="__('Title')"/>

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
                         autofocus/>
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-label for="description" :value="__('Description')"/>

                <x-textarea id="description" rows="5" class="block mt-1 w-full" type="email" name="description" :value="old('description')" required/>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ url('/recipes') }}">
                    {{ __('Go back') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Create') }}
                </x-button>
            </div>
        </form>
    </div>
</x-guest-layout>
