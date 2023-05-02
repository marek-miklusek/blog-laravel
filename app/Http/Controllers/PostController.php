<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\SavePostRequest;
use App\Http\Requests\UpdatePostRequest;

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
            'posts' => Post::with('comments', 'user', 'tags')->latest()->get()
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
    public function store(SavePostRequest $request)
    {
        $post = auth()->user()->posts()->create(
            $request->all()
        );

        // Simultaneously adds and removes tags (sync)
        // Attach tags to post
		$post->tags()->sync($request->get('tags'));

        session()->flash('message', 'You created a new post');
        return redirect()->route('posts.show', $post->slug);
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
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());

        // Simultaneously adds and removes tags (sync)
        // Attach tags to post
		$post->tags()->sync($request->get('tags'));

        session()->flash('message', 'Your post was updated');
        return redirect('/posts/'.$post->slug);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // When this returns true, we can continue in code bellow (PostPolicy)
        $this->authorize('update', $post);

        $post->delete();

        session()->flash('message', 'Your post was deleted');
        return redirect('/');
    }


    /**
     * Show form for removing specified resource.
     */
    public function delete(Post $post)
    {
	    // When this returns true, we can continue in code bellow(CommentPolicy)
        $this->authorize('update', $post);

	    return view('posts.delete', [
            'post' => $post
        ]);
    }
}


/*
|--------------------------------------------------------------------------
| All tags select in AppServiceProvider method boot()
|--------------------------------------------------------------------------
*/
