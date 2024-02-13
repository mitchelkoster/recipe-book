<x-guest-layout>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl text-gray-800 px-8">{{__('All recipes')}}</h1>
        <p class="mt-2 text-gray-600 text-sm px-8">
            {{__('An overview of all recipes on this website.')}}
        </p>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden sm:rounded-lg">
            {{-- Pagination --}}
            <div class="w-full flex justify-end mb-10 pr-4">
                {{ $recipes->links('pagination::tailwind') }}
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            @forelse ($recipes as $recipe)
                {{-- Recipe card --}}
                {{-- TODO: This could be a component? --}}
                <section class="p-6 bg-white rounded shadow">
                    <div class="flex sm:flex-row flex-col items-center">
                        {{-- Recipe image --}}
                        {{--
                        <img
                            src="{{ asset('img/placeholder_recipe.png') }}"
                            alt="Random recipe"
                            class="mr-2 mb-4 sm:mb-0"
                            height="150"
                            width="150"
                        > --}}

                        {{-- Recipe details --}}
                        <x-recipe-card :recipe="$recipe"/>
                    </div>

                    {{-- tags --}}
                    <div class="text-center mt-4">
                        <ul class="flex flex justify-start">
                            @foreach ($recipe->tags as $tag)
                                <li class="py-0.5 px-2 mx-1 bg-green-200 text-green-800 rounded">
                                    <a href="#">{{ $tag->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                {{-- Recipe card --}}
                @empty
                    <p class="mx-8 text-lg text-green-600">{{__('No recipes are available yet!')}}</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="w-full flex justify-end mb-10 pr-4">
                {{ $recipes->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-guest-layout>
