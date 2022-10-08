<?php

namespace Tepuilabs\LaravelInstapago;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelInstapagoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-instapago')
            ->hasConfigFile('laravel-instapago');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function packageRegistered(): void
    {
        $this->app->bind('LaravelInstapago', function ($app) {
            return new LaravelInstapago($app);
        });
    }
}
