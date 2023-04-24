<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            // We can take all posts out from DB with other data(e.g.comments, user)
            // Eager loading for less sql query, which means it is faster
            'posts' => Post::with('comments', 'user')->latest()->get() 
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts,title',
            'text' => 'required'
        ]);

        $request['slug'] = Str::slug($request->title);

        auth()->user()->posts()->create(
            $request->all()
        );

        session()->flash('message', 'You created a new post');

        return redirect('/');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Eager loading for more efficient sql query
        $post->load('comments', 'comments.user');

        return view('posts.show',[
            'post' => $post
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   
        return view('posts.edit', [
            'post' => $post
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // When this returns true, we can continue in code bellow(PostPolicy)
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|unique:posts,title',
            'text' => 'required|unique:posts,text'
        ]);

        $post->title = $request->title;
        $post->text = $request->text;
        $post->slug = Str::slug($request->title);

        $post->save();

        session()->flash('message', 'Your post was updated');
        return redirect('/posts/'.$post->slug);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // When this returns true, we can continue in code bellow(CommentPolicy)
        $this->authorize('update', $post);

        $post->delete();

        session()->flash('message', 'Your post was deleted');
        return redirect('/');
    }
}
