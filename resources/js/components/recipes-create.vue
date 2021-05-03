<template>
    <form method="POST" action="#">
        <!-- Title -->
        <div>
            <label class="block font-medium text-sm text-gray-700" for="title" value="'Title"/>

            <input id="title"
                   class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                   type="text" name="title" required
                   autofocus/>
        </div>

        <!-- Description -->
        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="description" value="Description"/>

            <textarea id="description" rows="5"
                      class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' block mt-1 w-full"
                      type="email" name="description" required></textarea>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="#">
                Go back
            </a>

            <button
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                Create
            </button>
        </div>
    </form>
</template>
