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
        // Use user factories to automate seeding
        \App\Models\User::factory(10)->create();

        // Call custom seeders
        $this->call([
            MeasurementSeeder::class,
        ]);
    }
}
