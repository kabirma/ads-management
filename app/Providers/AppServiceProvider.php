<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Media;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $medias=Media::get();
        View::share('setting', $setting);
        View::share('medias', $medias);
    }
}
