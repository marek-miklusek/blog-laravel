<article class="comment">

    <div>
        {{ $comment->text }}
    </div>

    <footer class="comment-meta">

        <a href="{{ route('user', $comment->user->id) }}" class="author">
            @<strong>{{ $comment->user->name }}</strong>
        </a>

        <time datetime="{{ $comment->created_at->toW3cString() }}" class="comment-date">
            {{ $comment->created_at->diffForHumans() }}
        </time>

        @can('update', $comment)

            <a href="{{ route('comments.edit', $comment->id) }}" class="comment-edit-btn">edit</a>

            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn comment-delete-btn">x</button>
            </form>

        @endcan
           
    </footer>

</article>





