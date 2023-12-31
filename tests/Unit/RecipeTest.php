<?php

namespace Tests\Unit;

use App\Models\Recipe;
use App\Models\Tag;
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
        $recipe = Recipe::factory()->create();
        $this->assertEquals(1, $recipe->count());
    }

    /**
     * See if we can delete a recipe
     *
     * @return void
     */
    public function test_delete_recipe()
    {
        // Create users
        $user = User::factory()->create();
        $this->assertEquals(1, $user->count());

        // Add user to recipe
        $recipe = Recipe::factory()->create();
        $this->assertEquals(1, $recipe->count());

        // Recipe created
        $this->assertEquals(1, $recipe->count());

        // Remove recipe
        $recipe->delete();

        // Recipe removed
        $this->assertEquals(0, $recipe->count());
    }

    /**
     * See if we can update a recipe
     *
     * @return void
     */
    public function test_update_recipe()
    {
        // Create users
        $user = User::factory()->create();
        $this->assertEquals(1, $user->count());

        // Add user to recipe
        $recipe = Recipe::factory()->create();
        $this->assertEquals(1, $recipe->count());

        // Recipe created & get title
        $this->assertEquals(1, $recipe->count());
        $oldTitle = $recipe->firstOrFail()->title;

        // Update recipe & compare
        $recipe->firstOrFail()->update([
            'title' => 'updated',
            'description' => 'updated',
            'cover' => 'updated',
            'portions' => 10,
        ]);
        $newTitle = $recipe->firstOrFail()->title;

        // See if title has changed
        $this->assertNotEquals($oldTitle, $newTitle);
    }

    /**
     * See if we can get the last 6 recipe's
     *
     * @return void
     */
    public function test_get_latest_recipes()
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

    /**
     * See if a recipe has tags
     *
     * @return void
     */
    public function test_recipe_has_tags()
    {
        // Create a recipe with tags
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create([
            'user_id' => $user->id
        ]);

        // Create tags
        $tags = Tag::factory(30)->create();

        // Link tags to recipes on ORM
        foreach ($tags as $tag) {
            $recipe->firstOrFail()->tags()->attach($tag);
        }

        // See if a database relations are created
        $this->assertDatabaseHas('recipe_tags', [
            'recipe_id' => $recipe->firstOrFail()->id,
            'tag_id' => $tag->id
        ]);
    }
}
