<template xmlns="http://www.w3.org/1999/html">
    <form method="POST" action="#">

        <!-- Title -->
        <div>
            <label class="block rounded">
                <span class="block font-semibold text-md text-gray-700">Title</span>

                <input id="title"
                       class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                       type="text" name="title" placeholder="Cold pasta salad" required
                       autofocus/>
            </label>
        </div>

        <!-- Description -->
        <div class="mt-4">
            <label class="block rounded">
                <span class="block font-semibold text-md text-gray-700">Description</span>

                <textarea id="description" rows="5"
                          class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' block mt-1 w-full"
                          type="email" name="description" placeholder="This Italian cold pasta salad used Olives to..." required></textarea>
            </label>
        </div>

        <!-- Ingredients -->
        <div class="mt-4">
            <fieldset class="border px-4 rounded">
                <legend class="text-2xl text-green-600 px-8">Ingredients</legend>

                <div class="my-4 flex flex-col md:flex-row justify-center items-stretch">
                    <!-- Ingredient name -->
                    <input id="ingredient"
                           class="mb-4 md:mb-0 md:w-3/6 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           type="text" list="ingredients" name="ingredient" placeholder="Search ingredient" required
                           autofocus/>

                    <datalist id="ingredients">
                        <option value="Carrot"/>
                        <option value="Apple"/>
                        <option value="Ginger"/>
                        <option value="Tumeric"/>
                        <option value="Lentils"/>
                    </datalist>

                    <!-- Ingredient quantity -->
                    <input id="qty"
                       class="mb-4 md:mb-0 md:mx-2 md:w-1/6 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       type="number" name="qty" value="1" step="1" required
                       autofocus/>

                    <!-- Measurement -->
                    <select
                        class="md:w-2/6 form-select rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option>Grams (Metric)</option>
                        <option>Cups (Imperial)</option>
                    </select>
                </div>

                <!-- Add additional ingredient -->
                <div class="flex items-center justify-end my-4">
                    <a class="inline-flex items-center text-green-600 hover:text-green-500" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add
                    </a>
                </div>
            </fieldset>
        </div>

        <!-- Steps -->
        <div class="mt-4">
            <fieldset class="border px-4 rounded">
                <legend class="text-2xl text-green-600 px-8">Steps</legend>

                <!-- Step title -->
                <div class="mt-4">
                    <input id="step-title"
                           class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                           type="text" name="title" placeholder="Vegetable prep (optional)" required
                           autofocus/>
                </div>

                <!-- Step description -->
                <div class="mt-4 mb-8">
                    <textarea id="step-description" rows="5"
                          class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                          type="email" name="description" placeholder="Dice up one carrot in large chunks, quarter a pepper, etc." required></textarea>
                </div>

                <!-- Add additional step -->
                <div class="flex items-center justify-end my-4">
                    <a class="inline-flex items-center ml-2 text-green-600 hover:text-green-500" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add
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
                class="inline-flex items-center px-4 py-2 bg-green-800 text-green-50 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                Add Recipe
            </button>
        </div>

    </form>
</template>
