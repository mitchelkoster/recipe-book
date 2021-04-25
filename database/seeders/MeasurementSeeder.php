<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Seeder;
class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Imperial
        Measurement::create(['system' => 'imperial', 'type' => 'pound (lb)']);
        Measurement::create(['system' => 'imperial', 'type' => 'ounce (oz)']);
        Measurement::create(['system' => 'imperial', 'type' => 'pint (pt)']);
        Measurement::create(['system' => 'imperial', 'type' => 'fluid ounce (fl oz)']);
        Measurement::create(['system' => 'imperial', 'type' => 'ounce (oz)']);
        Measurement::create(['system' => 'imperial', 'type' => 'cup']);
        Measurement::create(['system' => 'imperial', 'type' => 'tablespoon (tbsp)']);
        Measurement::create(['system' => 'imperial', 'type' => 'teaspoon (tsp)']);

        // Metric
        Measurement::create(['system' => 'metric', 'type' => 'kilogram (kg)']);
        Measurement::create(['system' => 'metric', 'type' => 'gram (g)']);
        Measurement::create(['system' => 'metric', 'type' => 'liter (l)']);
        Measurement::create(['system' => 'metric', 'type' => 'deciliter (dl)']);
        Measurement::create(['system' => 'metric', 'type' => 'milliliter (ml)']);
        Measurement::create(['system' => 'metric', 'type' => 'tablespoon (tbsp)']);
        Measurement::create(['system' => 'metric', 'type' => 'teaspoon (tsp)']);
    }
}
