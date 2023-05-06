<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Indicates if the model should be timestamped.
	public $timestamps = false;

    // The attributes that are mass assignable.
	protected $fillable = ['name', 'description'];


    /*
    |--------------------------------------------------------------------------
    | Relationships between models(tables in DB)
    |--------------------------------------------------------------------------
    */

    // Get the users of this role
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
