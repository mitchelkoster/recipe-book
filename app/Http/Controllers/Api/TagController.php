<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Recipe;

class TagController extends Controller
{
    public function search(Request $request)
    {
        // Retrieve matching tags
        $query = Str::of($request->query('tag'))->lower();
        $tags = Tag::where('name', 'like', "%{$query}%")->take(12)->get('name');

        // Retrieve recipes associated with the tag
        $recipes = Recipe::whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('name', $tags);
        })->with('user')->select([
            'id', 'title', 'description', 'slug', 'portions', 'created_at', 'user_id'
        ])->with('tags')->select()->orderBy('title', 'asc')->get();

        return response()->json([
            'recipes' => $recipes,
            'tags' => $tags->pluck('name')->toArray()
        ]);
    }
}
