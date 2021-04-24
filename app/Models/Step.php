<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    // Timestamp is not required
    public $timestamps = false;

    /**
     * Get the recipe the step belongs to
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
