<?php

namespace Database\Seeders;

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
        ]);

        // Use user factories to automate seeding
        \App\Models\Recipe::factory(3)->create();
        \App\Models\Step::factory(rand(3, 12))->create();
        \App\Models\Ingredient::factory(7)->create();
        \App\Models\Tag::factory(12)->create();

        // Link random database tags to recipes
        foreach (\App\Models\Recipe::all() as $recipe)
        {
            $randomTag = \App\Models\Tag::inRandomOrder()
                ->firstOrFail()
                ->id;

            $randomIngredient = \App\Models\Ingredient::inRandomOrder()
                ->firstOrFail()
                ->id;


            $recipe->tags()->attach($randomTag);
            $recipe->ingredients()->attach($randomIngredient);
        }
    }
}
