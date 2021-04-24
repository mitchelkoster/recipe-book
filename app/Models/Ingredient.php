<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    /**
     * Get the recipe the ingredient belongs to
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Get the measurements associated with an ingredient
     */
    public function measurement()
    {
        return $this->hasOne(Measurement::class);
    }
}
