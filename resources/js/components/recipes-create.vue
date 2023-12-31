<template xmlns="http://www.w3.org/1999/html">
	<!-- Validation Errors -->
	<div class="mb-4">
        <!-- Display error message -->
		<div class="font-semibold text-red-600">{{ errors.message }}</div>

        <!-- Show all errors based on field -->
		<ul v-for="(errorList, field) in errors.errors" class="ml-3 mt-3 text-sm text-red-600">

			<li class="font-semibold">{{ field }}</li>

            <!-- One field might have multiple errors -->
            <ul v-for="error in errorList" class="ml-6 italic">
                <li>{{ error }}</li>
            </ul>
		</ul>
	</div>

    <!-- Action is handled by JS -->
    <form method="POST" action="#" @submit.prevent="onSubmit">

        <!-- Title -->
        <div>
            <label class="block rounded">
                <span class="block font-semibold text-md text-gray-700">Title</span>

                <input id="title"
                       class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                       type="text" name="title" placeholder="Cold pasta salad" maxlength="255" required
                       autofocus
                       v-model="recipe.title"
                />
            </label>
        </div>

        <!-- Description -->
        <div class="mt-4">
            <label class="block rounded">
                <span class="block font-semibold text-md text-gray-700">Description</span>

                <textarea id="description" rows="5"
                          class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' block mt-1 w-full"
                          type="email" name="description" placeholder="This Italian cold pasta salad used Olives to..." maxlength="255" required
                          v-model="recipe.description"></textarea>
            </label>
        </div>

        <!-- Portions -->
        <div class="mt-4">
            <label class="block rounded">
                <span class="block font-semibold text-md text-gray-700">Portions</span>

                <input
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                type="number" name="qty" step="1" min="1" max="255" required
                autofocus
                v-model="recipe.portions"
                />
            </label>
        </div>

        <!-- Ingredients -->
        <div class="mt-4">
            <label class="block rounded">
                <span class="block font-semibold text-md text-gray-700">Ingredients</span>

                <textarea id="ingredients" rows="5"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' block mt-1 w-full"
                        type="email" name="ingredients" placeholder="1 carrot&#10;2 onions&#10;4 cloves of garlic" required v-model="recipe.ingredients"></textarea>
            </label>
        </div>

        <!-- Steps -->
        <div class="mt-4">
            <fieldset class="border px-4 rounded">
                <legend class="text-2xl text-green-600 px-8">Steps (optional)</legend>

                <div v-for="(find, index) in recipe.steps">
                    <!-- Step title -->
                    <div class="mt-4">
                        <input id="step-title"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                            type="text" name="title" placeholder="Vegetable prep"
                            autofocus
                            v-model="find.title"/>
                    </div>

                    <!-- Step description -->
                    <div class="mt-4 mb-8">
                        <textarea id="step-description" rows="5"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                            type="text" name="step" placeholder="Dice up one carrot in large chunks, quarter a pepper, etc." required
                            autofocus
                            v-model="find.description"></textarea>
                    </div>
                </div>

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
                    <a class="inline-flex items-center text-green-600 hover:text-green-500" href="#" v-on:click.prevent="removeStep()">
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
            <a class="underline text-sm text-gray-600 hover:text-gray-900" v-bind:href="baseUrl">
                Go back
            </a>

            <button
                type="submit"
                @click="createRecipe"
                class="inline-flex items-center px-4 py-2 bg-green-800 text-green-50 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                Add Recipe
            </button>
        </div>

    </form>
</template>
<script>
export default {
    inheritAttrs:false,
    props: ['apikey'],
    data() {
        return {
			errors: [],
            recipe: {
                title: '',
                description: '',
                ingredients: '',
                portions: 1,
                cover: null,
                steps: [
                    {title: '', description: ''}
                ]
            }
        }
    },
    computed: {
        baseUrl() {
            // See if we are hosted on a sub-path (Array(3) [ "", "recipes", "create" ])
            let baseUrl = window.location.origin;
            let urlPathParts = window.location.pathname.split('/');

            if (urlPathParts.length > 3) {
                urlPathParts.splice(2, 2);
                baseUrl = baseUrl + urlPathParts.join('/');
            }

            return baseUrl;
        }
    },
    methods: {
        addStep() {
            this.recipe.steps.push({
                title: '',
                description: ''
            });
        },
        removeStep() {
            this.recipe.steps.pop();
        },
        createRecipe() {
            const url = `${this.baseUrl}/api/recipes`;
            const data = {
                title: this.recipe.title,
                description: this.recipe.description,
                portions: this.recipe.portions,
                ingredients: this.recipe.ingredients,
                cover: this.recipe.cover,
                steps: JSON.parse(JSON.stringify(this.recipe.steps)) // Required black magic for proxy element
            };
            const config = {
                headers:{
                    Authorization: `Bearer ${this.apikey}`,
                    Accept: 'application/json'
                }
            };

            this.$http.post(url, data, config).
            then((response) => {
                window.location.replace(`${this.baseUrl}/recipes/${response.data.id}`);
            })
            .catch((error) => {
				this.errors = error.response.data; // errors from response

                // Scroll to top of page
                document.body.scrollTop = document.documentElement.scrollTop = 0;
            })
        }
    }
}
</script>
