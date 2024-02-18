<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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

        // Start a database transaction
        DB::transaction(function () use ($request, $userId) {
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
            if ($request->input('tags') !== NULL) {
                foreach ($request->input('tags') as $tagName) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $recipe->tags()->attach($tag->id);
                }
            }

            return response(['id' => $recipe->id], 201);
        });
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

        // Start a database transaction
        DB::transaction(function () use ($request, $foundRecipe, $recipe) {
            // Update recipe
            $foundRecipe->title = $request->input('title');
            $foundRecipe->slug = Str::slug($request->input('title'), '-');
            $foundRecipe->description = $request->input('description');
            $foundRecipe->ingredients = $request->input('ingredients');
            $foundRecipe->cover = $request->input('cover');
            $foundRecipe->portions = $request->input('portions');
            $foundRecipe->save();

            // Update steps
            $steps = collect($request->input('steps'))->reject(function ($step) {
                return $step['title'] === null || $step['description'] === null;
            })->map(function ($step) {
                return new Step([
                    'description' => $step['title'],
                    'instructions' => $step['description']
                ]);
            });

            $recipe->steps()->delete();
            $recipe->steps()->saveMany($steps);

            // Update tags in the recipe
            $tagIds = [];
            foreach ($request->input('tags')as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $recipe->tags()->sync($tagIds);
        });

        return response(NULL, 200);
    }
}
