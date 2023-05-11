<?php

namespace App\Traits;

/**
 * Handles uploading and resizing of images for the given model
 */
trait UploadImage
{
    public function uploadImage($model, $file, $post_image = false)
	{
        // If no file or was not saved to temporary folder, go back
	    if ( ! $file || ! $file->isValid() ) return false;

        // Save file
        $file = $this->upload->saveFile($model, $file, $post_image);
        // Resize file
        $this->image->resizeImage($model, $file, $post_image);
    }
}
