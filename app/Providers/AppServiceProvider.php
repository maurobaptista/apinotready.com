<?php

namespace App\Providers;

use App\Models\Endpoint;
use App\Observers\EndpointObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Endpoint::observe(EndpointObserver::class);
    }
}
