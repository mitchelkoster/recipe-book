<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // each user favorites 1–5 recipes
        User::all()->each(function ($user) {
            $recipeIds = Recipe::inRandomOrder()
                ->take(rand(1, 5))   
                ->pluck('id');

            $user->favoriteRecipes()->syncWithoutDetaching($recipeIds);
    });
    }
}
