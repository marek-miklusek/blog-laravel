<div class="upload-files add-files">
    <label class="form-heading">add files:</label>
    <p class="input-files"><input type="file" name="items[]" class="my-1"></p>
	<a class="btn btn-info btn-sm float-end">one more</a>
</div>

@error('items.0')
    <p class="errors">{{ $message }}</p>
@enderror