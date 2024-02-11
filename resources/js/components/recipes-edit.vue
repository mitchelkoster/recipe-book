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
            <a class="underline text-sm text-gray-600 hover:text-gray-900" v-bind:href="recipeUrl">
                Go back
            </a>

            <button
                type="submit"
                @click="editRecipe"
                class="inline-flex items-center px-4 py-2 bg-green-800 text-green-50 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                Edit Recipe
            </button>
        </div>

    </form>
</template>
<script>
export default {
    inheritAttrs:false,
    props: ['apikey', 'originalRecipe'],
    data() {
        return {
			errors: [],
            recipe: {
                title: '',
                description: '',
                ingredients: '',
                portions: 1,
                cover: null,
                steps: []
            }
        }
    },
    computed: {
        baseUrl() {
            // See if we are hosted on a sub-path (Array(4) [[ "", "recipes", "33", "edit" ])
            let baseUrl = window.location.origin;
            let urlPathParts = window.location.pathname.split('/');

            // TODO: This should be abstracted to a general function
            // NOTE: This assumes you are hosting on a sub URL. E.g. "https://example.com/recipe-book/"
            if (urlPathParts.length > 4) {
                urlPathParts.splice(2, 3);
                baseUrl = baseUrl + urlPathParts.join('/');
            }

            return baseUrl;
        },
        recipeUrl() {
            // See if we are hosted on a sub-path (Array(4) [[ "", "recipes", "33", "edit" ])
            let baseUrl = window.location.origin;
            let urlPathParts = window.location.pathname.split('/');

            // This should be abstracted to a general function
            // NOTE: This assumes you are hosting on a sub URL. E.g. "https://example.com/recipe-book/"
            if (urlPathParts.length > 4) urlPathParts.slice(0, 4);
            else urlPathParts = urlPathParts.slice(0,3)

            return baseUrl + urlPathParts.join('/');
        },
        decodedRecipe() {
            return JSON.parse(this.originalRecipe);
        }
    },
    created() {
        this.recipe.title = this.decodedRecipe.title;
        this.recipe.description = this.decodedRecipe.description;
        this.recipe.ingredients = this.decodedRecipe.ingredients;
        this.recipe.portions = this.decodedRecipe.portions

        this.decodedRecipe.steps.forEach(step => {
            this.recipe.steps.push({
                id: step.id ? step.id : null,
                title: step.description,
                description: step.instructions
            });
        });
    },
    methods: {
        addStep() {
            this.recipe.steps.push({
                id: null,
                title: '',
                description: ''
            });
        },
        removeStep() {
            this.recipe.steps.pop();
        },
        editRecipe() {
            if ( ! confirm('Are you sure you want to modify this recipe?')) {
                return;
            }

            const url = `${this.baseUrl}/api/recipes/${this.decodedRecipe.id}`;
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
                    'Authorization': `Bearer ${this.apikey}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            };

            this.$http.patch(url, data, config).
            then((response) => {
                // Show flash message
                document.getElementById('alert').style = 'display: block';
                document.getElementById('alert').classList.value = 'max-w-6xl mx-auto bg-green-100 border-b-2 text-center border-green-500 text-green-700 p-4 mt-4 rounded';
                document.getElementById('alert').getElementsByTagName('p')[0].innerText = 'Your recipe has been modified. You will be redirected shortly...';

                // Scroll to top of page
                document.body.scrollTop = document.documentElement.scrollTop = 0;

                // Redirect after timeout
                window.setTimeout(() => {
                    window.location.replace(`${this.baseUrl}/recipes/${this.decodedRecipe.id}`);
                }, 5000)
            })
            .catch((error) => {
                // Show form errors
				this.errors = error.response.data;

                // Show flash message
                document.getElementById('alert').style = 'display: block';
                document.getElementById('alert').classList.value = 'max-w-6xl mx-auto bg-red-100 border-b-2 text-center border-red-500 text-red-700 p-4 mt-4 rounded';
                document.getElementById('alert').getElementsByTagName('p')[0].innerText = 'Your recipe could not be created.';

                // Scroll to top of page
                document.body.scrollTop = document.documentElement.scrollTop = 0;
            })
        }
    }
}
</script>
