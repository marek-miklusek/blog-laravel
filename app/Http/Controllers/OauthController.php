<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }


    public function callback($service)
    {
        $oauth_user = Socialite::driver($service)->user();

        // Try find a user in DB by email, if can't find, create him
        if ( ! $user = User::whereEmail($oauth_user->email)->first() ) {
            $user = User::updateOrCreate([
                'name' => $oauth_user->name,
                'email' => $oauth_user->email,
            ]);
        }
     
        // Log the user in
        Auth::login($user);
     
        session()->flash('message', 'Great, '.Auth::user()->name.' you are logged in now!');
        return redirect('/');
    }
}
