<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Recipe;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipeView>
 */
class RecipeViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isGuest = $this->faker->boolean(30); // 30% guest, tune as needed

        return [
            'recipe_id' => Recipe::inRandomOrder()->firstOrFail()->id,
            'user_id' => $isGuest ? null : User::query()->inRandomOrder()->value('id'),
            'viewer_id' => $isGuest ? (string) Str::uuid() : null,
            'last_viewed_at' => $this->faker->date(),
            'view_count' => rand(1, 6),
        ];
    }
}
