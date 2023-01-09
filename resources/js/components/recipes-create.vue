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
                       type="text" name="title" placeholder="Cold pasta salad" required
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
                          type="email" name="description" placeholder="This Italian cold pasta salad used Olives to..." required
                          v-model="recipe.description"></textarea>
            </label>
        </div>

        <!-- Portions -->
        <div class="mt-4">
            <label class="block rounded">
                <span class="block font-semibold text-md text-gray-700">Portions</span>

                <input 
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                type="number" name="qty" step="1" required
                autofocus
                v-model="recipe.portions"
                />
            </label>
        </div>

        <!-- Ingredients -->
        <div class="mt-4">
            <fieldset class="border px-4 rounded">
                <legend class="text-2xl text-green-600 px-8">Ingredients</legend>
                    <div class="my-4 flex flex-col md:flex-row justify-end items-stretch">
                        <select
                            class="md:w-2/6 form-select rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="selectedSystem" @change="updateSystem">
                            <option>Metric</option>
                            <option>Imperial</option>
                        </select>
                    </div>

                <div v-for="i in ingredientCount">
                    <div class="my-4 flex flex-col md:flex-row justify-center items-stretch">
                        <!-- Ingredient name -->
                        <input
                            class="mb-4 md:mb-0 md:w-3/6 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="text" list="ingredients" name="ingredient" placeholder="Search ingredient" required
                            autofocus/>

                        <!-- Ingredient quantity -->
                        <input 
                        class="mb-4 md:mb-0 md:mx-2 md:w-1/6 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        type="number" name="qty" value="1" step="1" required
                        autofocus/>

                        <!-- Measurement -->
                        <select
                            class="md:w-2/6 form-select rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option selected disabled value="">Measurement</option>
                            <option v-for="measurement in measurements" :value="measurement.id">
                                {{ measurement.type }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Shared data list for all ingredients -->
                <datalist id="ingredients">
                    <option v-for="ingredient in ingredients" :key="ingredient.id">
                        {{ ingredient.name}}
                    </option>
                </datalist>

                <!-- Add and remove ingredient actions -->
                <div class="flex justify-end items-center my-4">
                    <!-- Add additional ingredient -->
                    <a class="inline-flex items-center text-green-600 hover:text-green-500" href="#" v-on:click.prevent="addIngredient">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add
                    </a>

                    <!-- Remove additional ingredient -->
                    <a class="inline-flex items-center text-green-600 hover:text-green-500" href="#" v-on:click.prevent="removeIngredient">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                        Remove
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
    data() {
        return {
            ingredientCount: 1,
            selectedSystem: 'Metric',
            ingredients: {},
            measurements: {},
            baseUrl: window.location.origin,
			errors: [],
            recipe: {
                title: '',
                description: '',
                portions: 1,
                cover: null
            }
        }
    },
    beforeMount() {
        this.getIngredients()
        this.getMeasurements(this.selectedSystem)
    },
    methods: {
        addIngredient() {
            this.ingredientCount += 1
        },
        removeIngredient() {
            if (this.ingredientCount > 1)
                this.ingredientCount -= 1
        },
        getIngredients() {
            let url = `${window.location.origin}/api/ingredients`;
            
            this.$http.get(url).
            then((response) => {
                this.ingredients = response.data
            })
            .catch((error) => {
                console.error(error);
            })
        },
        getMeasurements(system) {
            let url = `${this.baseUrl}/api/measurements/${system.toLowerCase()}`;
            
            this.$http.get(url).
            then((response) => {
                this.measurements = response.data;
            })
            .catch((error) => {
                console.error(error);
            })
        },
        updateSystem() {
            this.getMeasurements(this.selectedSystem)
        },
        createRecipe() {
            let url = `${window.location.origin}/api/recipes`;    
            let data = {
                title: this.recipe.title,
                description: this.recipe.description,
                portions: this.recipe.portions,
                cover: this.recipe.cover
            };
            console.log(data); 
            
            this.$http.post(url, data).
            then((response) => {
                console.log(response);
                alert("success")
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