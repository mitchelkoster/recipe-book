<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Bulk data to insert
        $data = [
            // Imperial
            ['system' => 'imperial', 'type' => 'pound (lb)'],
            ['system' => 'imperial', 'type' => 'ounce (oz)'],
            ['system' => 'imperial', 'type' => 'pint (pt)'],
            ['system' => 'imperial', 'type' => 'fluid ounce (fl oz)'],
            ['system' => 'imperial', 'type' => 'ounce (oz)'],
            ['system' => 'imperial', 'type' => 'cup'],
            ['system' => 'imperial', 'type' => 'tablespoon (tbsp)'],
            ['system' => 'imperial', 'type' => 'teaspoon (tsp)'],

            // Metric
            ['system' => 'metric', 'type' => 'kilogram (kg)'],
            ['system' => 'metric', 'type' => 'gram (g)'],
            ['system' => 'metric', 'type' => 'liter (l)'],
            ['system' => 'metric', 'type' => 'deciliter (dl)'],
            ['system' => 'metric', 'type' => 'milliliter (ml)'],
            ['system' => 'metric', 'type' => 'tablespoon (tbsp)'],
            ['system' => 'metric', 'type' => 'teaspoon (tsp)'],
        ];

        // Use Eloquent model
        Measurement::insert($data);

        // Remove entries and create new ones
        DB::table('measurements')->delete();
        DB::table('measurements')->insert($data);
    }
}
