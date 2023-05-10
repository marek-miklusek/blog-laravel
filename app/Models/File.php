<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
				return asset('files-icons/pdf-file.png');
				break;
			case 'txt':
				return asset('files-icons/txt-file.png');
				break;
			case 'doc':
				return asset('files-icons/doc-file.png');
				break;
			case 'csv':
				return asset('files-icons/csv-file.png');
				break;
			default:
				return asset('files-icons/img.png');
				break;
		}
	}


    /*
    |--------------------------------------------------------------------------
    | Polymorphic Relationships between models(tables in DB)
    |--------------------------------------------------------------------------
    */

	// Uploaded file can belong user, post or anything
    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
