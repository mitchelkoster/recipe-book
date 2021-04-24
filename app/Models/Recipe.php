<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    /**
     * Get the ingredients that are required for a recipe
     */
    public function ingredients()
    {
        $this->hasMany(Ingredient::class);
    }

    /**
     * Get all steps to follow from a recipe
     */
    public function steps()
    {
        $this->hasMany(Step::class);
    }

    /**
     * The tags that belong to the recipe
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the user that created this recipe
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
