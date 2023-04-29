<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Homepage
Route::get('/', [PostController::class, 'index']);


// The methods will be executed only when user is logged in('auth')
Route::middleware('auth')->group(function () {

    // Posts
    Route::resource('posts', PostController::class);
 
    // Comments
    Route::resource('comments', CommentController::class)->only([
        'store', 'update', 'destroy', 'edit'
    ]);

    // User
    Route::get('user/{id}', [UserController::class, 'index'])
        ->where('id', '[0-9]+')->name('user');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Example how to use more segments in URI (segment can be optional {slug?})
| plus regular expression (->where)
|--------------------------------------------------------------------------
*/

// Route::get('whatever/{id}/{slug}', [PagesController::class, 'method'])
//     // Condition with regular expression, only numbers
//     ->where('id', '[0-9]+')
//     // Condition with regular expression, only small letters and hyphens
//     ->where('slug', '[a-z-]+');


