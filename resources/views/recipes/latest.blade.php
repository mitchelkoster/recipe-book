<x-guest-layout>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl text-gray-800">{{__('Latest recipes')}}</h1>
        <p class="mt-2 text-gray-600 text-sm">
            {{__('This page shows the latest recipes added. This is awesome for inspiration or to remnind yourself how that
             new dish was made again.')}}
        </p>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            @forelse ($recipes as $recipe)
                <!-- Recipe card -->
                    <section class="p-6 bg-white rounded shadow">
                        <div class="flex items-center">
                            <!-- Recipe image -->
                            <img
                                src="{{ asset('img/placeholder_recipe.png') }}"
                                alt="Random recipe"
                                class="mr-2"
                                height="150"
                                width="150"
                            >

                            <!-- Recipe details -->
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="{{ url('/recipes', $recipe->id) }}" class="underline text-green-600 ">
                                    {{ $recipe->title }}
                                </a>

                                <!-- portion and cook -->
                                <div class="text-sm color text-gray-500 mb-5">
                                    <div>{{ $recipe->portions }} portions</div>
                                    <div><a href="#"
                                            class="text-green-400 hover:text-green-600">{{ $recipe->user->name }}</a>
                                    </div>
                                </div>

                                <!-- description -->
                                <div class="mt-2 w-60 text-gray-600 text-sm">
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
        </div>
    </div>
</x-guest-layout>
