<?php

namespace DinandMentink\Markdown;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishResources();
        $this->serveAssets();
        $this->declareConfig();
        $this->loadRoutes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function publishResources()
    {
        $this->publishes(
            [
                __DIR__.'/config/nova-markdown.php' => config_path('nova-markdown.php'),
            ],
            'config'
        );
    }

    private function serveAssets()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('markdown', __DIR__.'/../dist/js/field.js');
            Nova::style('markdown', __DIR__.'/../dist/css/field.css');
        });
    }

    private function declareConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/nova-markdown.php',
            'nova-markdown'
        );
    }

    private function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
