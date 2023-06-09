<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // Get the route key for this model, default is (posts/id)
    // change it to (posts/slug)
	public function getRouteKeyName()
	{
		return 'slug';
	}


    // The attributes that are mass assignable
    protected $fillable = [
        'text', 'title', 'slug'
    ];


    // The newly created attributes are append to the object
    protected $appends = [
        //
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships between models(tables in DB)
    |--------------------------------------------------------------------------
    */

    // Get the Author of the blog post
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Get the comments of this post
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }


    // Post can have many tags
	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}


    // Polymorphic Relationships
    // Post can have many uploaded files
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

  
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    // Get the path from public folder for post image
    public function getImageAttribute()
	{
        $file = $this->files()->where('mime', 'like', 'image/%')->latest()->first();

        if ($file) {
            return asset('post-image/posts/'.$file->fileable_id.'/'.$file->filename);
        }
        return null;
    }


    // Display only documents with these extensions under post
    public function getPostFilesAttribute()
    {
        return $this->files()->whereIn('ext', ['pdf', 'txt', 'doc', 'csv'])->get();
    }


    // Format created_at
    public function getCreatedAtAttribute($value)
    {
        return date('j M Y, H:i', strtotime($value));
    }


    // Make datetime for HTML tag time
    public function getDatetimeAttribute()
    {
        return date('Y-m-d', strtotime($this->created_at));
    }


    // Format text to teaser
    public function getTeaserAttribute()
    {
        return Str::words($this->text, 50);
    }


    // Add paragraphs to text
    public function getFormatTextAttribute()
    {
        return add_paragraphs(filter_url(e($this->text)));
    }


    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    // Create slug from title before storing to DB
    public function setTitleAttribute($value)
    {   
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
