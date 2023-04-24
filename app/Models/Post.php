<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
