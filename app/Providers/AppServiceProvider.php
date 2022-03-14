<?php

namespace App\Providers;

use App\Modules\Site\Cart\Models\CartItem;
use App\Modules\Site\Catalog\Models\Picking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Date::setlocale(config('app.locale'));

        view()->composer('*', function ($view)
        {



        });
    }
}
