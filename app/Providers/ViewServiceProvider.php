<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         view()->composer('frontend.layouts.app', function($view){
            
           $countries = \App\Country::get();
           $cities = \App\City::where('country_id','99')->get();
           $subCities = \App\SubCity::get();

            
            $view->with(compact('countries','cities','subCities'));
        });

    }
}
