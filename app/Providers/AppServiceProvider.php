<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    public const HOME = '/welcome'; // <- ici tu définis la redirection

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
  
}
