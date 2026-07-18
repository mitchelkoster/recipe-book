<x-guest-layout>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl text-gray-800 px-8">{{__('Recently Viewed Recipes')}}</h1>
        <p class="mt-2 text-gray-600 text-sm px-8">
            {{__('A collection of your most recently viewed recipes.')}}
        </p>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden sm:rounded-lg">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            @forelse ($views as $view)
                <x-recipe-card :recipe="$view->recipe"/>
            @empty
                <p class="mx-8 text-lg text-green-600">{{__('You have not visited any recieps yet!')}}</p>
            @endforelse
            </div>
        </div>
    </div>
</x-guest-layout>
