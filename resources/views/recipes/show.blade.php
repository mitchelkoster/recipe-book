<x-guest-layout>
    <div class="max-w-6xl mx-auto">
        <header class="flex items-center flex-col bg-white rounded">
            <div class="text-center w-full">
                <h1 class="text-2xl text-gray-800 mt-8">{{ $recipe->title }}</h1>
                <p class="mt-2 text-gray-600">
                    {{ $recipe->description }}
                </p>
            </div>

            <div class="mt-2 p-2 w-full flex justify-evenly">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>

                    <a href="#" class="ml-2 text-green-400 hover:text-green-600">{{ $recipe->user->name }}</a>
                </div>

                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    <p class="ml-2">{{ $recipe->created_at }}</p>
                </div>

            </div>

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

        <main>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg> {{ $recipe->portions }} portions

            <p>Ingredients</p>
            <p>Step 1</p>
            <p>Step 2</p>
        </main>
    </div>
</x-guest-layout>
