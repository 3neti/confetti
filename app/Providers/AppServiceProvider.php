<?php

namespace App\Providers;

use Coreproc\MsisdnPh\Msisdn;
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
        Validator::extend('msisdn', function ($attribute, $value, $parameters) {
            return Msisdn::validate($value);
        });
    }
}
