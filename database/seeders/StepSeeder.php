<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Step;
use \App\Models\Recipe;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve all recipes from the database
        $recipes = Recipe::all();

        // Iterate over each recipe and create steps for it
        $recipes->each(function ($recipe) {
            Step::factory(3)->create(['recipe_id' => $recipe->id]);
        });
    }
}
