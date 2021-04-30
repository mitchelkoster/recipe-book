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
        // Call database seeders
        $this->call([
            UserSeeder::class,
            MeasurementSeeder::class,
            RecipeSeeder::class,
            StepSeeder::class,
            IngredientSeeder::class,
            TagSeeder::class
        ]);

        // Attach tags and ingredients to recipes
        foreach (Recipe::all() as $recipe)
        {
            // Attach random tags to recipes
            for( $i = 0; $i < rand(0, 5); $i++ ) {
                $randomTag = Tag::inRandomOrder()
                    ->firstOrFail()
                    ->id;

                $recipe->tags()->attach($randomTag);
            }

            // Attach random ingredients to recipes
            for( $i = 0; $i < rand(1, 7); $i++ ) {
                $randomIngredient = Ingredient::inRandomOrder()
                    ->firstOrFail()
                    ->id;

                $recipe->ingredients()->attach($randomIngredient);
            }
        }
    }
}
