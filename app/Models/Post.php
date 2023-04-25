<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // Get the route key for the model, default is (posts/id)
    // change it to (posts/slug)
	public function getRouteKeyName()
	{
		return 'slug';
	}


    // The attributes that are mass assignable
    protected $fillable = [
        'text', 'title', 'slug'
    ];


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


    // Format created_at (accessors)
    public function getCreatedAtAttribute($value)
    {
        return date('j M Y, H:i', strtotime($value));
    }


    // Format text to teaser (accessors)
    public function getTeaserAttribute()
    {
        return Str::words($this->text, 50);
    }


    public function getFormatTextAttribute()
    {
        return add_paragraphs(filter_url(e($this->text)));
    }
}
