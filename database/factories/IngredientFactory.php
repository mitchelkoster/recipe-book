<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Measurement;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // List of vegertables to populate the database with
        $commonVegetables = [
            'carrot', 'apple', 'chickpea', 'flour',
            'onion', 'zuccini', 'eggplant', 'maple syrup',
            'flax seed', 'tomato', 'potato', 'grape',
            'nutritonal yeast', 'tofu', 'soy milk', 'pasta',
        ];

        // Retrieve random vegatable
        $randomVegetable = $commonVegetables[array_rand($commonVegetables)];

        // Retrieve random measurement for recipe
        $randomMeasurementId = Measurement::inRandomOrder()
            ->firstOrFail()
            ->id;

        // Retrieve random recipe that the ingredient is used in
        $randomRecipeId = Recipe::inRandomOrder()
            ->firstOrFail()
            ->id;

        return [
            'name' => $randomVegetable,
            'qty' => rand(1, 10),
            'recipe_id' => $randomRecipeId,
            'measurement_id' => $randomMeasurementId
        ];
    }
}
