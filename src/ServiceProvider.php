<?php

namespace AylesSoftware\XeroLaravel;

use AylesSoftware\XeroLaravel\Facades\Xero as XeroFacade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(
            __DIR__.'/../database/migrations'
        );

        $this->app->singleton('Xero', function () {
            return new XeroHandler();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/xero-laravel.php' => config_path('xero-laravel.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            XeroFacade::class,
        ];
    }
}
