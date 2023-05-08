<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // The attributes that are not mass assignable
    protected $guarded = ['id'];

	
	// Icons for files
	public function imgFile($file)
	{
		switch ($file->ext) {
			case 'pdf':
				return asset('images/pdf-file.png');
				break;
			case 'txt':
				return asset('images/txt-file.png');
				break;
			case 'doc':
				return asset('images/doc-file.png');
				break;
			case 'csv':
				return asset('images/csv-file.png');
				break;
			default:
				# code...
				break;
		}
	}


    /*
    |--------------------------------------------------------------------------
    | Relationships between models(tables in DB)
    |--------------------------------------------------------------------------
    */

    // Get post for this file
	public function post()
	{
		return $this->belongsTo(Post::class);
	}


    /*
    |--------------------------------------------------------------------------
    | Public static functions
    |--------------------------------------------------------------------------
    */

	public static function saveFile($post, $file)
	{
        // Create new file
        $filesize = $file->getSize();
		$filepath = storage_path('posts/' . $post->id);
		$extension = $file->getClientOriginalExtension();
		$filename = str_replace(".$extension", "-". rand(11111, 99999) . ".$extension", $file->getClientOriginalName());

		// Save the file
		$file->move($filepath, $filename);

		// Store the file in Database
		return File::create([
			'post_id' => $post->id,
			'name' => $file->getClientOriginalName(),
			'filename' => $filename,
			'mime' => $file->getClientMimeType(),
			'ext' => $extension,
			'size' => $filesize,
		]);
	}
}
