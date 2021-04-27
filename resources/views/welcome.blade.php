<x-guest-layout>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl text-gray-800 mt-8"> Latest recipes</h1>
        <p class="mt-2 text-gray-600 text-sm">
            Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.
        </p>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                @for ($i = 0; $i < 6; $i++)
                    <!-- Recipe card -->
                    <div class="p-6 bg-white rounded shadow">
                        <div class="flex items-center">
                            <!-- Recipe image -->
                            <div class="h-1/2">
                                <img
                                    src="/img/placeholder_recipe.png"
                                    alt="Random recipe"
                                    class="mr-2"
                                >
                            </div>

                            <!-- Recipe content -->
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="#" class="underline text-green-600 ">
                                    Generic pasta recipe
                                </a>
                                
                                <div class="w-30 text-sm color text-gray-500 mb-5">
                                    <div>4 portions</div>
                                    <div><a href="#" class="text-green-400 hover:text-green-600">@Mitchel Koster</a></div>
                                </div>

                                <div class="mt-2 text-gray-600 text-sm">
                                    Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Recipe card -->
                @endfor
            </div>
        </div>
    </div>
</x-guest-layout>
