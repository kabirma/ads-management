<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Media;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Auth;

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
        $setting=Company::find(1);
        View::share('setting', $setting);
    }
}
