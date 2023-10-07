<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display the latest recipes.
     *
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        $recipes = Recipe::with('user')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('recipes.latest', compact('recipes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::with('user')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apiKey = auth()->user()->api_token;
        return view('recipes.create', ['apikey' => $apiKey]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $recipe = Recipe::with([
            'user', 'steps', 'tags'
        ])->find($recipe->id);

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $recipe = Recipe::with([
            'user', 'steps', 'tags'
        ])->find($recipe->id);

        return view('recipes.edit', compact('recipe'));
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

        // $foundRecipe->steps()->update($recipe->steps->toArray());

        // Update recipe details
        $foundRecipe->title = $request->title;
        $foundRecipe->description = $request->description;
        $foundRecipe->ingredients = $request->ingredients;
        $foundRecipe->cover = $request->cover;
        $foundRecipe->portions = $request->portions;

        // Update steps beloging to a recipe
        for ($i = 0; $i < count($foundRecipe->steps); $i++) {
            $foundRecipe->steps[$i]->description = $request->steptitle[$i];
            $foundRecipe->steps[$i]->instructions = $request->instructions[$i];
        }

        // Save recipe
        $foundRecipe->save();
        $foundRecipe->steps()->saveMany($foundRecipe->steps);

        return redirect('recipes'.'/'.$recipe->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe = Recipe::find($recipe->id)->firstOrFail();
        $recipe->steps()->delete();
        $recipe->delete();
        return redirect()->route('recipes');
    }
}
