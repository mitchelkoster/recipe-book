<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The recipes that belong to a tag
     */
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
