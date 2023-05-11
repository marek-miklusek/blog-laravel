<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Get the route key for this model, default is(user/id)
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


    // Check which role has user, return bool
    public function hasRole($role): bool
    {
        return $this->role->name === $role;
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships between models(tables in DB)
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


    // Get the role of this author
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    // Polymorphic Relationships
    // User can have one uploaded file
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->latest();
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    // Url link to avatar image
    public function getAvatarAttribute()
	{
		if ( ! $this->file ) return false;

		return [
			'full'  => $this->avatarSize(),
			'thumb' => $this->avatarSize('thumb'),
			'tiny'  => $this->avatarSize('tiny'),
		];
	}


    /*
    |--------------------------------------------------------------------------
    | Private functions
    |--------------------------------------------------------------------------
    */

    // Get size of avatar image for getAvatarAttribute()
	private function avatarSize($size = null)
	{
		$file = $this->file;
     
        $path = asset('profile-image/users/'.$file->fileable_id);
		$filename = $file->filename;

		if ($size) {
			$filename = basename($file->name, '.'.$file->ext) . '-' . $size . '.' . $file->ext;
		}

		return asset($path.'/'.$filename);
	}
}
