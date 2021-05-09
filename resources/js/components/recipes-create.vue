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
            <fieldset class="border px-4">
                <legend class="text-2xl text-green-600 px-8">Ingredients</legend>

                <!-- Ingredient name -->
                <div  class="mt-4">
                    <label class="block rounded">
                        <span class="block font-semibold text-md text-gray-700">Ingredient</span>

                        <input id="ingredient"
                               class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                               type="text" list="ingredients" name="ingredient" placeholder="Search for ingredients..." required
                               autofocus/>
                    </label>

                    <datalist id="ingredients">
                        <option value="Carrot"/>
                        <option value="Apple"/>
                        <option value="Ginger"/>
                        <option value="Tumeric"/>
                        <option value="Lentils"/>
                    </datalist>
                </div>

                <!-- Ingredient quantity -->
                <div class="mt-4">
                    <label class="block rounded">
                        <span class="block font-semibold text-md text-gray-700">Quantity</span>

                        <input id="qty"
                               class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                               type="number" name="qty" value="1" step="1" required
                               autofocus/>
                    </label>
                </div>

                <!-- Measurement -->
                <div class="mt-4 mb-8">
                    <label class="block rounded">
                        <span class="block font-semibold text-md text-gray-700">Measurement</span>
                        <select
                            class="form-select block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                            <option>Grams (Metric)</option>
                            <option>Cups (Imperial)</option>
                        </select>
                    </label>
                </div>
            </fieldset>
        </div>

        <!-- Steps -->
        <div class="mt-4">
            <fieldset class="border px-4">
                <legend class="text-2xl text-green-600 px-8">Steps</legend>
                <!-- Step title -->
                <div class="mt-4">
                    <label class="block rounded">
                        <span class="block font-semibold text-md text-gray-700">Title</span>

                        <input id="step-title"
                               class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                               type="text" name="title" placeholder="Prepping the veggies" required
                               autofocus/>
                    </label>
                </div>

                <!-- Step description -->
                <div class="mt-4 mb-8">
                    <label class="block rounded">
                        <span class="block font-semibold text-md text-gray-700">Description</span>

                        <textarea id="step-description" rows="5"
                                  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' block mt-1 w-full"
                                  type="email" name="description" placeholder="Dice up one carrot in large chunks..." required></textarea>
                    </label>
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
                Create
            </button>
        </div>

    </form>
</template>
