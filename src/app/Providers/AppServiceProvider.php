<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Responses\RegisterResponse;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            \Laravel\Fortify\Contracts\RegisterResponse::class,
            \App\Http\Responses\RegisterResponse::class
        );
    }

    public function boot(): void
    {
        //
    }
}
