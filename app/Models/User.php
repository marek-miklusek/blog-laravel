<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Get the route key for this model, default is (user/id)
    // change it to (user/name)
	public function getRouteKeyName()
	{
		return 'name';
	}


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships between models (tables in DB)
    |--------------------------------------------------------------------------
    */

    // Get the posts of this author
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }


    // Get the comments of this author
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    // Urldecode if the name has more than 1 word before displaying
    public function getNameAttribute($value)
    {
        return urldecode($value);
    }

    
    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    // Urlencode if the name has more than 1 word, before storing in DB
    public function setNameAttribute($value)
    {   
        $this->attributes['name'] = urlencode($value);
    }
}
