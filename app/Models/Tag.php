<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'name';
    }

    /**
     * The recipes that belong to a tag
     */
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_tags');
    }
}
