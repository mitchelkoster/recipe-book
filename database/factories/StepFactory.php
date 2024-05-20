<?php

namespace Database\Factories;

use App\Models\Step;
use Illuminate\Database\Eloquent\Factories\Factory;

class StepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Step::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $includeDescription = rand(1, 0);

        return [
            'description' => $includeDescription ? $this->faker->sentence() : NULL,
            'instructions' => $this->faker->paragraphs(rand(1, 3), true),
            'picture' => NULL
        ];
    }
}
