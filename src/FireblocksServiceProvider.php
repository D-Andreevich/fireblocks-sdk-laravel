<?php

namespace FireblocksSdkLaravel;

use Illuminate\Support\ServiceProvider;

class FireblocksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/fireblocks.php' => config_path('fireblocks.php'),
            ], 'config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/fireblocks.php', 'fireblocks'
        );
        $this->app->bind(FireblocksSdkClient::class);

    }
}