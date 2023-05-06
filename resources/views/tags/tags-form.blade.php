<button class="btn btn-primary">Submit</button>

<span class="or">
    or <a href="{{ url()->previous() }}">cancel</a>
</span>

<h5 class="add-tags">Add tags:</h5>

<div class="tags-create">

    @foreach($tags as $tag)

        <label class="checkbox tags-input">
            @if ($type == 'edit')
                <input type="checkbox" class="form-check-input" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'checked' : '' }}>
            @else
                <input type="checkbox" class="form-check-input" name="tags[]" value="{{ $tag->id }}">
            @endif
            {{ $tag->tag }}
        </label>

    @endforeach

</div>