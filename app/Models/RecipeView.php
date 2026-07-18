<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeView extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'user_id',
        'viewer_id',
        'last_viewed_at',
        'view_count',
    ];

    // Timestamp is not required
    public $timestamps = false;


    /**
     * User that has viewed the recipe
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Recipe that has been viewed
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }

}
