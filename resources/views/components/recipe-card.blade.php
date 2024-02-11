@props(['recipe'])

<div class="ml-4 leading-7 font-semibold flex-col items-center">
    <a href="{{ url('/recipes', $recipe->id) }}" class="mx-1 underline text-green-600 flex flex-col sm:flex-row items-center text-center sm:text-left">
        {{ $recipe->title }}
    </a>

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
    </div>

    {{-- description --}}
    <div class="mt-4 mx-1 w-60 text-gray-600 text-sm w-full text-center sm:text-left">
        {{ $recipe->description }}
    </div>
</div>
