<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'post_id' => 'required|integer|exists:posts,id'
        ]);

        $comment = auth()->user()->comments()->create(
            $request->all()
        );

        session()->flash('message', 'Your smart comment was added:)');
        return redirect('/posts/' . $comment->post->slug . '#comments');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', [
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // When this returns true, we can continue in code bellow(CommentPolicy)
        $this->authorize('update', $comment);

        $request->validate([
            'text' => 'required|unique:comments,text'
        ]);

        $comment->text = $request->text;
        $comment->save();

        session()->flash('message', 'Your comment was updated');
        return redirect('/posts/'.$comment->post->slug.'#comments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // When this returns true, we can continue in code bellow(CommentPolicy)
        $this->authorize('update', $comment);
    
        $comment->delete();

        session()->flash('message', 'Your comment was deleted');
        return redirect('/posts/'.$comment->post->slug.'#comments');
    }
}
