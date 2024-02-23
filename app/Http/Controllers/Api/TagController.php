<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagController extends Controller
{
    public function search(Request $request)
    {
        $query = Str::of($request->query('tag'))->lower();
        $tags = Tag::where('name', 'like', "%{$query}%")->take(12)->get('name');

        return response($tags, 200);
    }
}
