<x-guest-layout>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl text-gray-800 px-8">{{__('Latest recipes')}}</h1>
        <p class="mt-2 text-gray-600 text-sm px-8">
            {{__('This page shows the latest recipes added. This is awesome for inspiration or to remind yourself how that
             new dish was made again.')}}
        </p>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden sm:rounded-lg">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            @forelse ($recipes as $recipe)
                <x-recipe-card :recipe="$recipe"/>
            @empty
                <p class="mx-8 text-lg text-green-600">{{__('No recipes are available yet!')}}</p>
            @endforelse
            </div>
        </div>
    </div>
</x-guest-layout>
