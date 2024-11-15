<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Recipe;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $tag = Tag::where('name', $tag->name)->firstOrFail();

        // Retrieve recipes associated with the tag
        $recipes = Recipe::whereHas('tags', function ($query) use ($tag) {
            $query->where('name', $tag->name);
        })->with('user')->orderBy('title', 'asc')->paginate(20);

        return view('tags.show', compact('recipes'), compact('tag'));
    }

    /**
     * Show the form for creating searching tags.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('tags.search');
    }
}
