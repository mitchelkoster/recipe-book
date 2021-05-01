<x-guest-layout>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl text-gray-800 px-8">{{__('All recipes')}}</h1>
        <p class="mt-2 text-gray-600 text-sm px-8">
            {{__('An overview of all recipes on this website.')}}
        </p>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden sm:rounded-lg">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            @forelse ($recipes as $recipe)
                <!-- Recipe card -->
                <section class="p-6 bg-white rounded shadow">
                    <div class="flex sm:flex-row flex-col items-center">
                        <!-- Recipe image -->
                        <img
                            src="{{ asset('img/placeholder_recipe.png') }}"
                            alt="Random recipe"
                            class="mr-2 mb-4 sm:mb-0"
                            height="150"
                            width="150"
                        >

                        <!-- Recipe details -->
                        <div class="ml-4 leading-7 font-semibold w-full">
                            <a href="{{ url('/recipes', $recipe->id) }}" class="underline text-green-600 ">
                                {{ $recipe->title }}
                            </a>

                            <div class="flex flex-col md:flex-row md:justify-between">
                                <div class="flex mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>

                                    <a href="#" class="ml-2 text-green-400 hover:text-green-600">{{ $recipe->user->name }}</a>
                                </div>

                                <div class="flex text-sm mb-4 mt-2 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                        />

                                    </svg>

                                    <p class="ml-2">{{ $recipe->portions }} {{ __('portion(s)') }}</p>
                                </div>
                            </div>

                            <!-- description -->
                            <div class="mt-2 w-60 text-gray-600 text-sm w-full">
                                {{ $recipe->description }}
                            </div>
                        </div>
                    </div>

                    <!-- tags -->
                    <div class="text-center mt-4">
                        <ul class="flex flex justify-start">
                            @foreach ($recipe->tags as $tag)
                                <li class="py-0.5 px-2 mx-1 bg-green-200 border border-green-800 text-green-800 rounded">
                                    <a href="#">{{ $tag->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <!-- Recipe card -->
                @empty
                    <p class="text-lg text-green-600">{{__('No recipes are available yet!')}}</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="w-full flex justify-end mb-10">
                {{ $recipes->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-guest-layout>
