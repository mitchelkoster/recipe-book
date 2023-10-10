<x-guest-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <header class="flex items-center flex-col bg-white rounded">

            @if (session('status'))
            <div class="w-5/6 bg-green-100 border-b-2 text-center border-green-500 text-green-700 p-4 mt-4 rounded" role="alert">
                <p>Recipe has been {{ session('status') }}!</p>
            </div>
            @endif

            @auth
            <div class="flex flex-row justify-end mt-4 px-8 w-full">
                <a class="mt-1 underline text-sm text-gray-600 hover:text-gray-900" href="{{ url('/recipes').'/'.$recipe->id.'/edit'}}">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </div>
                </a>

                <span class="mt-2 mx-4">{{ __('or') }}</span>
                <form method="POST" action="{{ url('/recipes') .'/' . $recipe->id }}" class="mt-1 underline text-sm text-red-600 hover:text-red-800">
                    @csrf
                    @method("DELETE")
                    <button type="submit" onclick="return confirm('{{ __('Are you sure you want to delete this recipe?') }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </form>
            </div>
            @endauth

            <!-- Title and description -->
            <section class="text-center w-full">
                <h1 class="text-2xl text-gray-800 mt-8 px-8">{{ $recipe->title }}</h1>
                <p class="mt-1 text-gray-600 px-8">
                    {{ $recipe->description }}
                </p>
            </section>

            <!-- Recipe cook -->
            <section class="my-2 flex flex-col md:flex-row md:justify-between">
                <div class="flex my-1 mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>

                    <p class="ml-2">{{ $recipe->user->name }}</p>
                </div>

                <!-- created date -->
                <div class="flex my-1 mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>

                    <p class="ml-2">{{ $recipe->created_at->toDateString() }}</p>
                </div>

                <!-- portions -->
                <div class="flex my-1 mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                        />

                    </svg>

                    <p class="ml-2">{{ $recipe->portions }} {{ __('portion(s)') }}</p>
                </div>
            </section>

            <!-- Tags -->
            <section class="text-center">
                <ul class="flex">
                    @foreach ($recipe->tags as $tag)
                        <li class="py-0.5 px-2 mx-1 bg-green-200 text-green-800 rounded">
                            <a href="#">{{ $tag->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </section>

            {{-- Only show image if available--}}
            @if ( isset($recipe->cover) )
                <img
                    src="{{ asset('img/placeholder_recipe.png') }}"
                    alt="Random recipe"
                    class="object-fill h-48 w-full"
                    height="150"
                    width="150"
                >
            @endif
        </header>

        <main class="flex items-center flex-col bg-white rounded">
            <section class="flex items-center flex-col bg-white rounded my-2 my-2 w-11/12 border-t">
                <h1 class="text-2xl text-gray-800 mt-4 border-y text-green-600">{{ __('Ingredients') }}</h1>

                <ul class="mt-2 text-gray-600 list-disc">
                    @if (count(explode("\r\n", $recipe->ingredients)) > 1)
                        @foreach(explode("\r\n", $recipe->ingredients) as $ingredient)
                            <li>{{ str_replace('\\r\\n', '', $ingredient) }}</li>
                        @endforeach
                    @else
                        @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                            <li>{{ str_replace('\\n', '', $ingredient) }}</li>
                        @endforeach
                    @endif
                </ul>
            </section>

            <!-- Show all steps -->
            <section class="flex items-center flex-col bg-white rounded mb-8 my-2 w-11/12 border-t">
                <h1 class="text-2xl text-green-600 mt-4 border-y">{{ __('Steps') }}</h1>

                @forelse ($recipe->steps as $step)
                    <section class="flex flex-col bg-white rounded my-2 text-left">
                        <h2 class="text-xl text-gray-800 mt-4 px-8">{{ $step->description }}</h2>

                        @foreach(explode("\n", $step->instructions) as $instruction)
                            <p class="mt-2 text-gray-600 px-8">{{ $instruction }}</p>
                        @endforeach

                        @if ( isset($step->picture) )
                            <img
                                src="{{ asset('img/placeholder_recipe.png') }}"
                                alt="Random recipe"
                                class="object-fill h-48 w-full mt-8"
                                height="150"
                                width="150"
                            >
                        @endif
                    </section>
                @empty
                    <p class="text-lg text-green-600 mt-4">{{__('This recipe just contains ingredients for now!')}}</p>
                @endforelse
            </section>
        </main>
    </div>
</x-guest-layout>
