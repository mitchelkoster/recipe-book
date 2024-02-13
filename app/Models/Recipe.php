<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    // Allow mass assignment
    protected $guarded = [];

    public function canBeUpdatedBy(User $user, $recipe)
    {
        return $user->id === $recipe->user_id;
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
}
