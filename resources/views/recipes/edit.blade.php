<x-guest-layout>
    <div class="max-w-6xl mx-auto mt-6 px-6 py-4 sm:px-6 lg:px-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="text-2xl text-gray-800 mb-2"> {{ __('Edit Recipe') }}</h1>

        <form method="POST" action="{{ url('/recipes').'/'.$recipe->id }}">
            @csrf
            @method("PATCH")
            <!-- Title -->
            <div>
                <label class="block rounded">
                    <span class="block font-semibold text-md text-gray-700">Title</span>

                    <input id="title"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        type="text" name="title" value="{{ $recipe->title }}" required
                        autofocus />
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
                        type="number" name="qty" step="1" required value="{{ $recipe->portions }}" autofocus/>
                </label>
            </div>

            <!-- Ingredients -->
            <div class="mt-4">
                <label class="block rounded">
                    <span class="block font-semibold text-md text-gray-700">Ingredients</span>

                    <textarea id="Ingredients" rows="5"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' block mt-1 w-full"
                            type="email" name="Ingredients" required>{{str_replace('\\n', "\n", $recipe->ingredients) }}</textarea>
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
                            <input id="step-title"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                type="text" name="title" value="{{ $step->description }}"
                                autofocus />
                        </div>

                        <!-- Step ingredients -->
                        <div class="mt-4 mb-8">
                            <textarea id="ingredients" rows="5"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                type="email" name="ingredients" required
                                autofocus >{{ $step->instructions }}</textarea>
                        </div>
                    </div>
                    @empty
                    <p class="text-lg text-green-600">{{__('No steps are available yet!')}}</p>
                    @endforelse

                    <div class="flex justify-end items-center my-4">
                        <!-- Add additional step -->
                        <a class="inline-flex items-center text-green-600 hover:text-green-500" href="#" v-on:click.prevent="addStep">
                            <div class="flex items-center justify-end my-4">
                                <a class="inline-flex items-center ml-2 text-green-600 hover:text-green-500" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add
                                </a>
                            </div>
                        </a>

                        <!-- Remove additional step -->
                        <a class="inline-flex items-center text-green-600 hover:text-green-500" href="#" v-on:click.prevent="removeStep(i)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                            Remove
                        </a>
                    </div>
                </fieldset>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="#">
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

