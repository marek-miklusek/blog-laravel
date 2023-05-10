<div class="upload-files add-files">
    <label class="form-heading">add image:</label>
    <p class="input-files"><input type="file" name="image" class="my-1"></p>
</div>

@error('image')
    <p class="errors">{{ $message }}</p>
@enderror

