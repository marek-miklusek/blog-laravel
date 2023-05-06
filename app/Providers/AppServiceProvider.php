<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Required my own functions
        require_once app_path('Helpers/functions.php');

        // Select all tags at once for edit and create method in PostController
        // and include into view('partials.tags-form')
	    view()->composer('tags.tags-form', function($view)
        {
	        $view->with('tags', Tag::latest()->get());
        });

    
        /*
        |--------------------------------------------------------------------------
        | Events
        |--------------------------------------------------------------------------
        */

        // When post is created, edited or deleted the cache is cleared
        Post::saved(function() {
            Cache::forget('posts');
        });

        Post::deleted(function() {
            Cache::forget('posts');
        });
    }
}
