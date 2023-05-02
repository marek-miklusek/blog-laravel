<?php

namespace App\Providers;

use App\Models\Tag;
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
        require_once app_path('Helpers/functions.php');

        // Include $tags into view('partials.tags-form')
	    view()->composer('tags.tags-form', function($view)
        {
	        $view->with('tags', Tag::all());
        });
    }
}
