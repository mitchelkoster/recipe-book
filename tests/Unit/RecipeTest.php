<?php

namespace Tests\Unit;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    // Reset the database after each test
    use RefreshDatabase;

    /**
     * See if we can create a recipe
     *
     * @return void
     */
    public function test_create_recipe()
    {
        // Create users
        $user = User::factory()->create();
        $this->assertEquals(1, $user->count());

        // Add user to recipe
        $recipes = Recipe::factory(1)->create();
        $this->assertEquals(1, $recipes->count());
    }

    /**
     * See if we can get the last 6 recipe's
     *
     * @return void
     */
    public function test_latest_recipes()
    {
        // Create a few recipes with different users
        $user = User::factory()->create();
        Recipe::factory(20)->create([
            'user_id' => $user->id
        ]);

        // Retrieve latest recipes
        $recipes = Recipe::with('user')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $this->assertCount(6, $recipes);
    }

    /**
     * See if a recipe belongs to a user
     *
     * @return void
     */
    public function test_recipe_belongs_to_user()
    {
        // Create a user with an recipe
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create([
            'user_id' => $user->id
        ]);

        // Fetch recipes
        $this->assertInstanceOf(User::class, $recipe->firstOrFail()->user);
    }
}
