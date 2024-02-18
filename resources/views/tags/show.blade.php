<x-guest-layout>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl text-gray-800 px-8">{{__('Recipes based on tag')}}</h1>
        <p class="mt-2 text-gray-600 text-sm px-8">
            {{__('An overview of all recipes filtered on ')}} <span class="bg-green-200 text-green-800 rounded py-1 px-2">{{ $tag->name }}</span>
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

                        <x-recipe-card :recipe="$recipe"/>
                    </div>

                    <x-tags :tags="$recipe->tags"/>
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
