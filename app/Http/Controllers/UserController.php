<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{  
    /**
     * Display a listing of the resource.
     */
    public function index($name)
    {
        $user = User::whereName($name)->firstOrFail(); 

        $this->authorize('view', $user);

        return view('posts.index', [
            'posts' => $user->posts,
            'title' => 'My beautiful posts',
        ]);
    }
}
