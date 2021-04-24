<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    // Timestamp is not required
    public $timestamps = false;

    /**
     * Thre recipies that are made with an ingredient
     */
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients');
    }

    /**
     * Get the measurements associated with an ingredient
     */
    public function measurement()
    {
        return $this->hasOne(Measurement::class);
    }
}
