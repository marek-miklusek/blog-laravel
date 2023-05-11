<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class ImageService
{
    // Resize images and create thumbs
    public function resizeImage($model, $file, $post_image = false)
	{
        // Resize post image 
        if ($post_image) {
		    $filepath = public_path('post-image/posts/'.$model->id.'/'.$file->filename);

            // Big image
		    $img = Image::make($filepath);

            // Make post image
            $img->resize(600, null, function ($constraint){       
            $constraint->aspectRatio();})
                ->crop(600, 250)
                ->save($filepath);
            
		    return true;
        }
        
        // Resize profile image
        $path = public_path('profile-image/users/'.$model->id.'/');
        
        // Get path and basename
		$filepath = $path.$file->filename;
		$filename = basename($file->name, '.'.$file->ext);

		// Big image
		$img = Image::make($filepath);

        // Create thumb image
        $img->resize(375, null, function ($constraint){       
            $constraint->aspectRatio();})
            ->crop(375, 416, 0, 0)
            ->save($path . $filename . '-thumb.' . $file->ext);

        // Big image again
		$img = Image::make($filepath);
          
        // Create tiny image
        $img->resize(50, null, function ($constraint){       
            $constraint->aspectRatio();})
            ->crop(50, 50)
            ->save($path . $filename . '-tiny.' . $file->ext);

		return true;
	}
}