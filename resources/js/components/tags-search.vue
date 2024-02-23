<template>
    <!-- Show search bar -->
    <div class="mb-4 relative mx-auto w-full">
        <input v-model="tag" @input="fetchTags"
            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block"
            type="search" name="search" placeholder="bread">

        <button type="button" class="absolute right-0 top-0 mt-5 mr-4">
            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                width="512px" height="512px">
                <path
                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
            </svg>
        </button>
    </div>

    <!-- Show resulting tags -->
    <section v-if="suggestedTags.length > 0" class="flex items-center flex-col bg-white rounded my-2 my-2 w-11/12 border-t">
        <h1 class="text-2xl text-gray-800 my-4 border-y text-green-600">Tags</h1>

        <div class="text-center mb-4">
            <ul class="flex flex-wrap justify-start px-4 space-x-4 space-y-2">
                <li v-for="tag in suggestedTags" :key="tag.id" @click="selectTag(tag)"
                    class="py-0.5 px-2 bg-green-200 text-green-800 rounded min-w-10">
                    <a :href="tagUrl(tag)">{{ tag }}</a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Show resulting Recipes -->
    <section v-if="suggestedRecipes.length > 0"
        class="flex items-center flex-col bg-white rounded my-2 my-2 w-11/12 border-t">
        <h1 class="text-2xl text-gray-800 my-4 border-y text-green-600">Recipes</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <div v-for="recipe in suggestedRecipes" class="p-6 bg-white rounded shadow">
                <div class="flex sm:flex-row flex-col items-center">
                    <div class="ml-4 leading-7 font-semibold flex-col items-center">
                        <a :href="recipeUrl(recipe.slug)"
                            class="mx-1 underline text-green-600 flex flex-col sm:flex-row items-center text-center sm:text-left">
                            {{ recipe.title }}
                        </a>

                        <div class="flex flex-col sm:flex-row items-center text-gray-500">
                            <div class="flex mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>

                                <p class="ml-2 mt-1 text-sm">{{ recipe.user.name }}</p>
                            </div>

                            <div class="flex text-sm mt-2 mx-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />

                                </svg>

                                <p class="ml-2 mt-1">{{ recipe.portions }} portion(s)</p>
                            </div>
                        </div>


                        <div class="mt-4 mx-1 w-60 text-gray-600 text-sm w-full text-center sm:text-left">
                            {{ recipe.description }}
                        </div>
                    </div>
                </div>

                <!-- Show tags -->
                <div class="text-center mt-4">
                    <ul class="flex flex justify-start">
                        <li v-for="tag in recipe.tags" class="py-0.5 px-2 mx-1 bg-green-200 text-green-800 rounded">
                            <a :href="tagUrl(tag.name)">{{ tag.name }}</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            tag: '',
            suggestedTags: [],
            suggestedRecipes: []
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
            // Make sure we at least have 3 characters to search for
            if (this.tag.length == 0 || this.tag.length < 3) {
                this.suggestedRecipes = []
                this.suggestedTags = []
                return
            }

            // Fetch tags
            const url = `${this.baseUrl}/api/tags/search`;
            const params = new URLSearchParams();
            params.append('tag', this.tag);

            this.$http.get(url, { params: params }).
                then((response) => {
                    this.suggestedTags = response.data.tags;
                    this.suggestedRecipes = response.data.recipes;
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        selectTag(tag) {
            this.tag = tag;
        },
        tagUrl(tag) {
            return `${this.baseUrl}/tags/${tag}`;
        },
        recipeUrl(slug) {
            return `${this.baseUrl}/recipes/${slug}`;
        }
    }
};
</script>
