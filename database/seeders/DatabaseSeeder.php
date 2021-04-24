<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Empty tables before seeding
        DB::table('users')->delete();
        DB::table('ingredients')->delete();
        DB::table('measurements')->delete();

        // Call custom seeders
        $this->call([
            MeasurementSeeder::class,
        ]);

        // Use user factories to automate seeding
        \App\Models\User::factory(10)->create();
        \App\Models\Recipe::factory(3)->create();
        \App\Models\Ingredient::factory(7)->create();
    }
}
