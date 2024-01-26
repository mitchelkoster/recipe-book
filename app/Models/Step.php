<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Step extends Model
{
    use HasFactory, SoftDeletes;

    // Timestamp is not required
    public $timestamps = false;

    protected $fillable = [
        'description',
        'instructions',
        'picture',
        'recipe_id'
    ];

    /**
     * Get the recipe the step belongs to
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
