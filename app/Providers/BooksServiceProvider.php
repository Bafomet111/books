<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BooksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Books', 'App\Services\BooksService');
    }
}
