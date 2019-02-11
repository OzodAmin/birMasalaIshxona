<?php

namespace App\Providers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Cart;
use Session;
use Auth;


class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {
            if (Auth::check()) {
               
            }
            $locale = LaravelLocalization::getCurrentLocale();
            $view->with(compact(['locale']));
        });
    }

    public function register()
    {
        //
    }
}
