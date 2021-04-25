<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Step;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Step::factory(rand(3, 12))->create();
    }
}
