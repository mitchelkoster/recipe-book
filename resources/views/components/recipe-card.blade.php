@props(['recipe'])
<section class="p-6 bg-white rounded shadow">
    <div class="flex sm:flex-row flex-col items-center">
        <div class="ml-4 leading-7 font-semibold flex-col items-center">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                {{-- Recipe title  --}}
                <a href="{{ url('/recipes', $recipe) }}" class="mx-1 underline text-green-600 flex flex-col sm:flex-row items-center text-center sm:text-left">
                    {{ $recipe->title }}
                </a>

                {{-- Favorite recipe --}}
                @auth
                  <form method="POST" action="{{ route('recipes.favorite', $recipe) }}">
                        @csrf
                        <button type="submit" class="focus:outline-none">
                            @if($recipe->is_favorite)
                                <!-- Filled heart -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="mt-1 w-8 h-8 text-red-400"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                </svg>
                            @else
                                <!-- Outline heart -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="mt-1 w-8 h-8 text-red-400 hover:text-red-600"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                                </svg>
                            @endif
                        </button>
                    </form>
                @endauth
            </div>

            <div class="flex flex-col sm:flex-row items-center text-gray-500">
                <div class="flex mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>

                    <p class="ml-2 mt-1 text-sm">{{ $recipe->user->name }}</p>
                </div>

                <div class="flex text-sm mt-2 mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                        />

                    </svg>

                    <p class="ml-2 mt-1">{{ $recipe->portions }} {{ __('portion(s)') }}</p>
                </div>

                <!-- views -->
                <div class="flex text-sm mt-2 mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    {{-- Show total personal views if authenticated, otherwise show total views  --}}
                    @auth
                        <p class="ml-2">{{ $recipe->personalViews }} {{ __('My views') }}</p>
                    @else    
                        <p class="ml-2">{{ $recipe->total_views }} {{ __('Total views') }}</p>
                    @endauth
                </div>
            </div>

            {{-- description --}}
            <div class="mt-4 mx-1 w-60 text-gray-600 text-sm w-full text-center sm:text-left">
                {{ $recipe->description }}
            </div>
        </div>

    </div>
    <x-tags :tags="$recipe->tags" />
</section>
