<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Recipe;
use App\Models\RecipeFavorite;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RecipeFavorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->firstOrFail()->id,
            'recipe_id' => Recipe::inRandomOrder()->firstOrFail()->id
        ];
    }
}
