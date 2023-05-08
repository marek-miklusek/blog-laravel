<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\FileController;
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
    Route::resource('posts', PostController::class)->except('index');
	Route::get('posts/{post}/delete', [PostController::class, 'delete'])->name('posts.delete');
 
    // Comments
    Route::resource('comments', CommentController::class)->only([
        'store', 'update', 'destroy', 'edit'
    ]);

    // Tags
    Route::resource('tags', TagController::class)->only([
        'create', 'store', 'show', 'destroy'
    ]);

    // Users
    Route::get('user/{name}', [UserController::class, 'index'])->name('user');

    // Files
    Route::get('download/{id}/{name}', [FileController::class, 'download']);
    Route::get('delete/{id}/', [FileController::class, 'destroy']);

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


