<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Get the route key for this model, default is (tag/id)
    // change it to (tag/tag)
	public function getRouteKeyName()
	{
		return 'tag';
	}


    // Indicates if the model should be timestamped.
	public $timestamps = false;


    // The attributes that are mass assignable.
	protected $fillable = ['tag'];


    /*
    |--------------------------------------------------------------------------
    | Relationships between models (tables in DB)
    |--------------------------------------------------------------------------
    */

    // A tag can belong to many posts
	public function posts()
	{
		return $this->belongsToMany(Post::class)->latest();
	}


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    // public function getEncodedTagAttribute()
    // {
    //     return urlencode($this->tag);
    // }

    
    // Urldecode if tag has more than 1 word before displaying
    public function getTagAttribute($value)
    {
        return urldecode($value);
    }


    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    // Urlencode if tag has more than 1 word, before storing in DB
    public function setTagAttribute($value)
    {   
        $this->attributes['tag'] = urlencode($value);
    }
}
