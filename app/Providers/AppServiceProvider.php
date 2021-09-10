<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        \View::share('channels', Channel::all());  // was loading before database migrations, Thus bringing an error
        View::composer('*', function ($view) {
            $view->with('channels', Channel::all());
        });
    }
}
