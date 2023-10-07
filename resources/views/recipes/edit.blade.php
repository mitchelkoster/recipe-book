<x-guest-layout>
    <div class="max-w-6xl mx-auto mt-6 px-6 py-4 sm:px-6 lg:px-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="text-2xl text-gray-800 mb-2"> {{ __('Edit Recipe') }}</h1>

        <form method="POST" action="{{ url('/recipes').'/'.$recipe->id}}">
            @csrf
            @method("PATCH")
            <!-- Title -->
            <div>
                <label class="block rounded">
                    <span class="block font-semibold text-md text-gray-700">Title</span>

                    <input id="title"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        type="text" name="title" value="{{ $recipe->title }}" required autofocus />
                </label>
            </div>

            <!-- Description -->
            <div class="mt-4">
                <label class="block rounded">
                    <span class="block font-semibold text-md text-gray-700">Description</span>

                    <textarea id="description" rows="5"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' block mt-1 w-full"
                            type="email" name="description" required>{{ $recipe->description }}</textarea>
                </label>
            </div>

            <!-- Portions -->
            <div class="mt-4">
                <label class="block rounded">
                    <span class="block font-semibold text-md text-gray-700">Portions</span>
                        <input
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        type="number" name="portions" step="1" required value="{{ $recipe->portions }}" autofocus/>
                </label>
            </div>

            <!-- Ingredients -->
            <div class="mt-4">
                <label class="block rounded">
                    <span class="block font-semibold text-md text-gray-700">Ingredients</span>

                    <textarea id="Ingredients" rows="5"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' block mt-1 w-full"
                            type="email" name="ingredients" required>{{str_replace('\\n', "\n", $recipe->ingredients) }}</textarea>
                </label>
            </div>

            <!-- Steps -->
            <div class="mt-4">
                <fieldset class="border px-4 rounded">
                    <legend class="text-2xl text-green-600 px-8">Steps</legend>

                    @forelse($recipe->steps as $step)
                    <div>
                        <!-- Step title -->
                        <div class="mt-4">
                            <input id="steptitle"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                type="text" name="steptitle[]" value="{{ $step->description }}"
                                autofocus />
                        </div>

                        <!-- Step ingredients -->
                        <div class="mt-4 mb-8">
                            <textarea id="ingredients" rows="5"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                type="email" name="instructions[]" required
                                autofocus >{{ $step->instructions }}</textarea>
                        </div>
                    </div>
                    @empty
                    <p class="text-lg text-green-600">{{__('No steps are available yet!')}}</p>
                    @endforelse
                </fieldset>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ url('recipes/'.$recipe->id) }}">
                    Go back
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-green-800 text-green-50 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                    Edit Recipe
                </button>
            </div>

        </form>
    </div>
</x-guest-layout>

