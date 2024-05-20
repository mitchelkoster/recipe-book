<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Tag;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::factory(50)->create()->each(function ($recipe) {
            $tags = Tag::factory()->count(rand(1, 5))->create();
            $recipe->tags()->attach($tags);
        });
    }
}
