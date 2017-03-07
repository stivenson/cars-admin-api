<?php

namespace senseibistro\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if ($this->app->environment() !== 'production') {
//            $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
//            $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
//        }
        /*if ($this->app->environment() !== 'production') {
            $this->app->register('Iber\Generator\ModelGeneratorProvider');
        }*/
    }
}
