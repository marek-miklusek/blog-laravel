<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\SaveCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveCommentRequest $request)
    {
        $comment = auth()->user()->comments()->create(
            $request->all()
        );

        session()->flash('message_c', 'Your smart comment was added:)');
        return redirect('/posts/' . $comment->post->slug . '#comments');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('comments.edit', [
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());
        
        session()->flash('message_c', 'Your comment was updated');
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

        session()->flash('message_c', 'Your comment was deleted');
        return redirect('/posts/'.$comment->post->slug.'#comments');
    }
}
