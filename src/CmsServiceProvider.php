<?php

namespace Cms\App;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->loadViewsFrom(__DIR__.'/views', 'cms');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes/web.php';
        include __DIR__ . '/routes/api.php';

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        /**
         * Register config and views
         */
        $this->mergeConfigFrom(__DIR__ . '/config/cms-app.php', 'cms-app');
        $this->publishes([
            __DIR__ . '/config/cms-app.php' => config_path('cms-app.php'),
        ]);

    }
}
