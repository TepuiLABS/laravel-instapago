<?php

namespace Tepuilabs\LaravelInstapago;

use Illuminate\Support\ServiceProvider;
use Tepuilabs\LaravelInstapago\Commands\LaravelInstapagoCommand;

class LaravelInstapagoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-instapago.php' => config_path('laravel-instapago.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/laravel-instapago'),
            ], 'views');

            $migrationFileName = 'create_laravel_instapago_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                LaravelInstapagoCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-instapago');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-instapago.php', 'laravel-instapago');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
