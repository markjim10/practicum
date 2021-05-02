<?php

namespace App\Providers;

use Coreproc\MsisdnPh\Msisdn;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Builder::defaultStringLength(191);

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
