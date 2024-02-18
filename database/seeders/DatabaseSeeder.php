<?php

namespace Database\Seeders;

use \App\Models\Recipe;
use \App\Models\Tag;
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
            RecipeSeeder::class,
            TagSeeder::class,
            StepSeeder::class,
        ]);
    }
}
