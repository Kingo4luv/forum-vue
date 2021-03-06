<?php

namespace App\Providers;

use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Channel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \View::composer('*', function($view){
            $channels = \Cache::rememberForever('channels', function (){
               return Channel::all();
            });
           $view->with('channels', Channel::all());
        });

        \Validator::extend('spamfree', 'App\Rules|SpamFree@passes');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
