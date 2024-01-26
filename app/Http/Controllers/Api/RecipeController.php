<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Step;
use App\Http\Requests\StoreRecipeRequest;

class RecipeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreRecipeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        // Make sure we are recieving JSON
        if ( ! $request->expectsJson()) {
            abort(400);
        }

        // Save recipe
        $recipe = new Recipe();
        $recipe->cover = $request->input('cover');
        $recipe->title = $request->input('title');
        $recipe->description = $request->input('description');
        $recipe->portions = $request->input('portions');
        $recipe->ingredients = $request->input('ingredients');

        // Fetch all steps for the recipe
        $steps = [];
        foreach ($request->input('steps') as $step) {
            $steps[] = new Step([
                'description' => $step['title'],
                'instructions' => $step['description']
            ]);
        }

        // Fetch the user ID
        $apikey = $request->header('Authorization');
        $apikey = explode('Bearer ', $apikey)[1];
        $recipe->user_id = User::where(['api_token' => $apikey])->first()->id;

        // Save recipe
        $recipe->save();

        // Save steps if provided
        if (count($steps) >= 1 && $steps[0]['instructions'] !== null && $steps[0]['description'] !== null) {
            $recipe->steps()->saveMany($steps);
        }

        return response(['id' => $recipe->id], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Recipe $recipe, Request $request)
    {
        // Fetch existing recipe
        $foundRecipe = Recipe::find(['id' => $recipe->id])->firstOrFail();
        if (! $foundRecipe) {
            abort(400);
        }

        // Update recipe details
        $foundRecipe->title = $request->title;
        $foundRecipe->description = $request->description;
        $foundRecipe->ingredients = $request->ingredients;
        $foundRecipe->cover = $request->cover;
        $foundRecipe->portions = $request->portions;

        // Update steps beloging to a recipe
        for ($i = 0; $i < count($foundRecipe->steps); $i++) {
            // TODO: Trying to access array offset on value of type null
            $foundRecipe->steps[$i]->description = $request->description[$i];
            $foundRecipe->steps[$i]->instructions = $request->instructions[$i];
        }

        // Fetch the user ID
        $apikey = $request->header('Authorization');
        $apikey = explode('Bearer ', $apikey)[1];
        $recipe->user_id = User::where(['api_token' => $apikey])->first()->id;

        // Save recipe
        $foundRecipe->save();

        // Save steps if provided
        if (count($steps) >= 1 && $steps[0]['instructions'] !== null && $steps[0]['description'] !== null) {
            $recipe->steps()->saveMany($steps);
        }

        return response(NULL, 200);
    }
}
