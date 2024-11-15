<x-guest-layout>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl text-gray-800 px-8">{{__('All recipes')}}</h1>
        <p class="mt-2 text-gray-600 text-sm px-8">
            {{__('An overview of all recipes on this website.')}}
        </p>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 overflow-hidden sm:rounded-lg">
            {{-- Pagination --}}
            <div class="w-full flex justify-end mb-6 pr-4">
                {{ $recipes->links('pagination::tailwind') }}

                {{-- To avoid GUI issues and further modification of the paginator, only show on the first page --}}
                @if( ! request()->has('page') || request()->query('page') == 1)
                <div class="flex flex-col items-center justify-between">
                    <p class="hidden sm:block text-sm text-gray-700 leading-5">{{ __('# Results') }}</p>
                    <select id="resultsPerPage" onchange="changedResultCount(this.value)" class="relative w-full h-full items-center ml-4 pr-8 sm:mt-2 text-sm font-bold text-green-600 bg-white border border-gray-300 leading-5 border border-gray-300 cursor-default rounded-md text-center leading-5">
                        <option value="20" class="text-gray-600">20</option>
                        <option value="50" class="text-gray-600">50</option>
                        <option value="100" class="text-gray-600">100</option>
                    </select>
                </div>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-6">
                @forelse ($recipes as $recipe)
                    <x-recipe-card :recipe="$recipe"/>
                @empty
                    <p class="mx-8 text-lg text-green-600">{{__('No recipes are available yet!')}}</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="w-full flex justify-end mb-4 pr-4">
                {{ $recipes->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    <script>
    function changedResultCount(option) {
        let params = new URLSearchParams(location.search);
        params.set('recipe-count', option);

        window.location.search = params.toString();
    }

    function setSelectFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const paramValue = urlParams.get('recipe-count');

        if (paramValue) {
            const selectElement = document.getElementById('resultsPerPage');
            const options = selectElement.options;

            for (let i = 0; i < options.length; i++) {
                if (options[i].value === paramValue) {
                    selectElement.selectedIndex = i;
                    break;
                }
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        setSelectFromUrl();
    });
    </script>
</x-guest-layout>
