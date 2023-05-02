<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveTagRequest;

class TagController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::latest()->get();

        return view('tags.create', [
            'tags' => $tags
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveTagRequest $request)
    {
        Tag::create($request->all());

        session()->flash('message', 'You created a new tag:)');
        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show($tag)
	{
        $tag = Tag::whereTag($tag)->firstOrFail(); 

		return view('posts.index', [
            'title' => $tag->tag,
            'posts' => $tag->posts
        ]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        session()->flash('message', 'Tag was deleted');
        return back();
    }
}
