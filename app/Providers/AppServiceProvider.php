<?php

namespace App\Providers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\RequestModel;
use Carbon\Carbon;
use Auth;



class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {
            $locale = LaravelLocalization::getCurrentLocale();
            $view->with(compact(['locale']));
        });

        view()->composer('layouts.user', function ($view) {
            $notifications = null;
            if (Auth::check()) {
                $notifications = RequestModel::where('user_id', auth()->id())
                                ->where('expire_at', '>', Carbon::now())
                                ->get();
            }
            $view->with(compact(['notifications'])
            );
        });
    }

    public function register()
    {
        //
    }
}
