<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Create ingredients
        $ingredients = [];
        for ($i = 0; $i < rand(3, 8); $i++) {
            $ingredients[] = strval($this->faker->randomDigit(1)) . ' ' . $this->faker->words(3, true);
        }

        return [
            'title' => $this->faker->unique()->sentence(),
            'description' => Str::of($this->faker->paragraph())->limit(150),
            'ingredients' => implode("\n", $ingredients),
            'cover' => NULL,
            'portions' => rand(1, 6),
            'user_id' => User::inRandomOrder()->firstOrFail()->id
        ];
    }
}
