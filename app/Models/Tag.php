<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Get the route key for this model, default is(tag/id)
    // change it to (tag/tag)
	public function getRouteKeyName()
	{
		return 'tag';
	}


    // Indicates if the model should be timestamped.
	public $timestamps = false;


    // The attributes that are mass assignable.
	protected $fillable = ['tag'];


    // The newly created attributes are append to the object
    protected $appends = [
        //
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships between models(tables in DB)
    |--------------------------------------------------------------------------
    */

    // A tag can belong to many posts
	public function posts()
	{
		return $this->belongsToMany(Post::class)->latest();
	}
}
