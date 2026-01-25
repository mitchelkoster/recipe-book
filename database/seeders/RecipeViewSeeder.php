<?php

namespace Database\Seeders;

use App\Models\RecipeView;
use Illuminate\Database\Seeder;

class RecipeViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeView::factory(30)->create();
    }
}
