<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    // Allow mass assignment
    protected $guarded = [];

    // Properties
    protected $appends = ['is_favorite'];

    public function canBeUpdatedBy(User $user, $recipe)
    {
        return $user->id === $recipe->user_id;
    }


    public function getIsFavoriteAttribute() {

        $user = Auth::user();
        if (!$user) {
            return false;
        }
    
        $isFavorited = $this->favoritedByUsers()
            ->where('recipe_favorites.user_id', $user->id) 
            ->exists();

        return $isFavorited;
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get all steps to follow from a recipe
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    /**
     * The tags that belong to the recipe
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'recipe_tags');
    }

    /**
     * Get the user that created this recipe
     */
    public function user()
    {
        return $this->belongsTo(User::class)->select(['id', 'name']);
    }

    /**
     * Get the users that favorited this recipe
     */
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'recipe_favorites');
    }
    
    /**
     * Get all recent views for this recipe.
     */
    public function views()
    {
        return $this->hasMany(RecipeView::class, 'recipe_id');
    }

    /**
     * Get the total view count for this recipe.
     */
    public function getTotalViewsAttribute(): int
    {
        return $this->views()->sum('view_count');
    }
}
