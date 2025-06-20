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
        $recipes = Recipe::with(['user', 'tags'])
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('recipes.latest', compact('recipes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Handle custom pagination
        $paginationCount = 20;
        if ($request->integer("recipe-count") > 0) {
            $paginationCount = $request->integer("recipe-count");
        }

        $recipes = Recipe::with(['user', 'tags'])
            ->orderBy('title', 'asc')
            ->paginate($paginationCount);

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
        // Authorize the user to update the recipe
        if ( ! $recipe->canBeUpdatedBy(auth()->user(), $recipe)) {
            abort(403, 'Unauthorized');
        }

        $recipe = Recipe::with([
            'user', 'steps', 'tags'
        ])->find($recipe->id);

        $apiKey = auth()->user()->api_token;
        return view('recipes.edit', ['apikey' => $apiKey, 'recipe' => $recipe]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        // Authorize the user to update the recipe
        if ( ! $recipe->canBeUpdatedBy(auth()->user(), $recipe)) {
            abort(403, 'Unauthorized');
        }

        $recipe = Recipe::where('slug', $recipe->slug)->firstOrFail();
        $recipe->steps()->delete();
        $recipe->delete();

        return redirect()->route('recipes')->with('alert', [
            'type' => 'danger',
            'message' => 'Recipe has been removed!'
        ]);
    }
}
