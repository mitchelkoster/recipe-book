<?php

namespace Database\Seeders;

use \App\Models\Recipe;
use \App\Models\Tag;
use \App\Models\Ingredient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call custom seeders
        $this->call([
            UserSeeder::class,
            MeasurementSeeder::class,
            RecipeSeeder::class,
            StepSeeder::class,
            IngredientSeeder::class,
            TagSeeder::class
        ]);

        // Link random database tags to recipes
        foreach (Recipe::all() as $recipe)
        {
            $randomTag = Tag::inRandomOrder()
                ->firstOrFail()
                ->id;

            $randomIngredient = Ingredient::inRandomOrder()
                ->firstOrFail()
                ->id;


            $recipe->tags()->attach($randomTag);
            $recipe->ingredients()->attach($randomIngredient);
        }
    }
}
