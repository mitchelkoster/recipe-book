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
        $description = Str::of($this->faker->paragraph())->limit(20);
        
        $randomUserId = User::inRandomOrder()
            ->firstOrFail()
            ->id;

        return [
            'title' => $this->faker->sentence(),
            'description' => $description,
            'cover' => NULL,
            'portions' => rand(1, 6),
            'user_id' => $randomUserId
        ];
    }
}
