<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Recipe;

class TagController extends Controller
{
    public function suggestion(Request $request)
    {
        // Retrieve matching tags
        $query = Str::of($request->query('tag'))->lower();
        $tags = Tag::where('name', 'like', "%{$query}%")->take(12)->get('name');

        return response()->json([
            'tags' => $tags->pluck('name')->toArray()
        ]);
    }

    public function search(Tag $tag)
    {
        // TODO: Keep parameter searching for when searchig on more than one tag

        // // Retrieve matching tags
        // $query = Str::of($request->query('tag'))->lower();
        // $tags = Tag::where('name', 'like', "%{$query}%")->take(12)->get('name');

        // // Retrieve recipes associated with the tag
        // $recipes = Recipe::whereHas('tags', function ($query) use ($tags) {
        //     $query->whereIn('name', $tags);
        // })->with('user')->select([
        //     'id', 'title', 'description', 'slug', 'portions', 'created_at', 'user_id'
        // ])->with('tags')->select()->orderBy('title', 'asc')->get();

        // return response()->json([
        //     'recipes' => $recipes,
        //     'tags' => $tags->pluck('name')->toArray()
        // ]);

        $tag = Tag::where('name', $tag->name)->firstOrFail();

        // Retrieve recipes associated with the tag
        $recipes = Recipe::whereHas('tags', function ($query) use ($tag) {
            $query->where('name', $tag->name);
        })->with('user')->orderBy('title', 'asc')->get();

        return response()->json($recipes);
    }
}
