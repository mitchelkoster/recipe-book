<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Ingredient;
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

        // TODO: See if ingredients exist and add to table if not
        $ingredients = [];
        foreach ($request->input('ingredients') as $ingredient) {
            if ( ! Ingredient::where(['name'=>'x'])->first()) {
                $ingredients[] = new Ingredient([
                    'name' => $ingredient['name'],
                    'qty' => $ingredient['qty'],
                    'measurement_id' => $ingredient['type']
                ]);
            }
        }

        // Fetch all steps for the recipe
        $steps = [];
        foreach ($request->input('steps') as $step) {
            $steps[] = new Step([
                'description' => $step['description'],
                'instructions' => $step['title']
            ]);
        }

        // Fetch the user ID
        $apikey = $request->header('Authorization');
        $apikey = explode('Bearer ', $apikey)[1];
        $recipe->user_id = User::where(['api_token' => $apikey])->first()->id;

        $recipe->save();
        $recipe->steps()->saveMany($steps);
        $recipe->ingredients()->saveMany($ingredients);

        return response(NULL, 201);
    }
}
