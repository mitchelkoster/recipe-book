<template>
    <!-- Show search bar -->
    <div class="pt-2 relative mx-auto">
        <input v-model="tags" @input="fetchTags"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block"
            type="search" name="search" placeholder="Search for recipes...">

        <button type="button" class="absolute right-0 top-0 mt-5 mr-4">
            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                width="512px" height="512px">
                <path
                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
            </svg>
        </button>

        <!-- Show results -->
        <div>
            <ul>
                <li v-for="tag in suggestions" :key="tag.id" @click="selectTag(tag)">
                    {{ tag.name }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tags: '',
            suggestions: []
        };
    },
    computed: {
        baseUrl() {
            // See if we are hosted on a sub-path (Array(3) [ "", "recipes", "create" ])
            let baseUrl = window.location.origin;
            let urlPathParts = window.location.pathname.split('/');

            // This should be abstracted to a general function
            // NOTE: This assumes you are hosting on a sub URL. E.g. "https://example.com/recipe-book/"
            if (urlPathParts.length > 3) {
                urlPathParts.splice(2, 2);
                baseUrl = baseUrl + urlPathParts.join('/');
            }

            return baseUrl;
        }
    },
    methods: {
        fetchTags() {
            console.log('fetch tags...')

            const url = `${this.baseUrl}/api/tags/search`;
            const data = {};
            const config = {
                headers:{
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            };

            this.$http.post(url, data, config).
            then((success) => {
                console.log(success)
            })
            .catch((error) => {
                console.log(error)
            })
        },
        selectTag(tag) {
            this.searchQuery = tag.name;
            this.showSuggestions = false;
        }
    }
};
</script>
