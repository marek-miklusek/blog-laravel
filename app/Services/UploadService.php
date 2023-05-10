<?php

namespace App\Services;

use App\Models\File;

class UploadService
{
	// Save file to disc
	public function saveFile($model, $file, $post_image = false)
	{
        // Make path for file
		$dirname = strtolower(class_basename($model)) . 's';

		if ($post_image) {
			$filepath = public_path("post-image/$dirname/$model->id");
		}
		else if ($dirname === 'users') {
			$filepath = public_path("profile-image/$dirname/$model->id");
		} 
        else {
			$filepath = storage_path("$dirname/$model->id");
		}

		$extension = $file->getClientOriginalExtension();

        $filesize = $file->getSize();
		$filename = str_replace(".$extension", "-" . rand(11111, 99999) . ".$extension", $file->getClientOriginalName());

		// Save the file
		$file->move($filepath, $filename);

		// Add file to database
		return $this->addFileToDatabase($file, $filename, $filesize, $model);
	}


	// Store file's meta-data in the Database
	public function addFileToDatabase($file, $filename, $filesize, $model)
	{
		return File::create([
            'fileable_id' => $model->id,
			'fileable_type' => get_class($model),
			'name' => $file->getClientOriginalName(),
			'filename' => $filename,
			'mime' => $file->getClientMimeType(),
			'ext' => $file->getClientOriginalExtension(),
			'size' => $filesize,
		]);
	}
}