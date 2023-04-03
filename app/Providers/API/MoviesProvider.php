<?php

namespace App\Providers\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class MoviesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('getPopular', function () {
            return Http::withOptions([
                'verify' => false,
                'base_uri' => 'https://api.themoviedb.org/3/'
                
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
