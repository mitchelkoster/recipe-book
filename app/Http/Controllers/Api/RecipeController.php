<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Step;
use App\Models\Tag;
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

        // Fetch the user ID
        $apikey = $request->header('Authorization');
        $apikey = explode('Bearer ', $apikey)[1];
        $userId = User::firstOrFail()->where(['api_token' => $apikey])->get('id');

        // Save recipe
        $recipe = Recipe::create([
            'user_id' => $userId[0]->id,
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title'), '-'),
            'description' => $request->input('description'),
            'portions' => $request->input('portions'),
            'ingredients' => $request->input('ingredients')
        ]);

        $steps = collect($request->input('steps'))->map(function ($step) {
            return new Step([
                'description' => $step['title'],
                'instructions' => $step['description']

            ]);
        });
        $recipe->steps()->saveMany($steps);

        // Fetch all tags for recipe
        foreach ($request->input('tags') as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $recipe->tags()->attach($tag->id);
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

        // Update recipe
        $foundRecipe->title = $request->input('title');
        $foundRecipe->slug = Str::slug($request->input('title'), '-');
        $foundRecipe->description = $request->input('description');
        $foundRecipe->ingredients = $request->input('ingredients');
        $foundRecipe->cover = $request->input('cover');
        $foundRecipe->portions = $request->input('portions');
        $foundRecipe->save();

        // Update all steps in the recipe
        $currentStepIds = [];
        foreach ($request->input('steps') as $step) {
            $tmp = Step::updateOrCreate(
                ['id' => $step['id'], 'recipe_id' => $recipe->id],
                ['description' => $step['title'], 'instructions' => $step['description'], 'recipe_id' => $recipe->id]
            );

            $currentStepIds[] = $tmp['id'];
        }

        // See which ID's no longer exist compared to the original so the steps can be removed
        $stepsToRemove = $foundRecipe->steps->filter(function ($step) use ($currentStepIds) {
            return !in_array($step['id'], $currentStepIds);
        })->pluck('id');

        // Remove steps
        Step::destroy($stepsToRemove);

        return response(NULL, 200);
    }
}
