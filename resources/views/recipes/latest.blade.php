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
                    <div class="p-6 bg-white rounded shadow">
                        <div class="flex items-center">
                            <!-- Recipe image -->
                            <img
                                src="{{ asset('img/placeholder_recipe.png') }}"
                                alt="Random recipe"
                                class="mr-2"
                                height="150"
                                width="150"
                            >

                            <!-- Recipe content -->
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="#" class="underline text-green-600 ">
                                    {{ $recipe->title }}
                                </a>

                                <div class="text-sm color text-gray-500 mb-5">
                                    <div>{{ $recipe->portions }} portions</div>
                                    <div><a href="#"
                                            class="text-green-400 hover:text-green-600">{{ $recipe->user->name }}</a>
                                    </div>
                                </div>

                                <div class="mt-2 w-60 text-gray-600 text-sm">
                                    {{-- Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end. --}}
                                    {{ $recipe->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Recipe card -->
                @empty
                    <p class="text-lg text-green-600">{{__('No recipes are available yet!')}}</p>
                @endforelse
            </div>
        </div>
    </div>
</x-guest-layout>
