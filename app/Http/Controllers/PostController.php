<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Services\UploadService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\SavePostRequest;

class PostController extends Controller
{
    use UploadImage;

    protected $upload;
    protected $image;

    public function __construct(UploadService $upload, ImageService $image)
    {
        $this->upload = $upload;
        $this->image = $image;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // We will save all posts to cache, then the query does not have to be 
        // run again and again and all posts are only pulled from the cache
        $posts = Cache::rememberForever('posts', function() {
            // We can take all posts out from DB with other data(e.g.comments, user)
            // Eager loading for less sql query, which means it is faster
            return Post::with('comments', 'user', 'tags')->latest()->get();
        });

        return view('posts.index', [
            'posts' => $posts
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // All tags for create and edit select in AppServiceProvider method boot()
        return view('posts.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SavePostRequest $request)
    {
        $post = $request->user()->posts()->create(
            $request->all()
        );

        // Simultaneously adds and removes tags(sync)
        // as well attach tags to post
		$post->tags()->sync($request->get('tags'));

        // Upload files
	    $this->uploadFiles($post, $request->file('items'));

        // Upload Image
	    $this->uploadImage($post, $request->file('image'), true);


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
    public function update(SavePostRequest $request, Post $post)
    {
        // When this returns true, we can continue in code bellow(PostPolicy)
        $this->authorize('update', $post);

        $post->update($request->all());

        // Simultaneously adds and removes tags(sync)
        // as well attach tags to post
		$post->tags()->sync($request->get('tags'));

        // Upload files
	    $this->uploadFiles($post, $request->file('items'));

        // Upload Image
	    $this->uploadImage($post, $request->file('image'), true);

        session()->flash('message', 'Your post was updated');
        return redirect('/posts/'.$post->slug);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // When this returns true, we can continue in code bellow(PostPolicy)
        $this->authorize('update', $post);

        $post->files()->delete();
        $post->delete();

        // Remove files from storage folder
        File::deleteDirectory(storage_path('posts/'.$post->id));

        // Remove image from public folder
        File::deleteDirectory(public_path('post-image/posts/'.$post->id));

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


    /*
    |--------------------------------------------------------------------------
    | Private functions
    |--------------------------------------------------------------------------
    */

    private function uploadFiles($post, $files)
	{
		if ($files) {
            foreach ($files as $file) {
                if ( ! $file || ! $file->isValid() ) continue;
                $this->upload->saveFile($post, $file);
            }
        }
	}
}


