<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    // Allow mass assignment
    protected $guarded = [];

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
