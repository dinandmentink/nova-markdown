<?php

namespace DinandMentink\Markdown;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('markdown', __DIR__.'/../dist/js/field.js');
            Nova::style('markdown', __DIR__.'/../dist/css/field.css');
        });

        $this->publishes([
            __DIR__.'/config/nova-markdown.php' =>
                config_path('nova-markdown.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/config/nova-markdown.php',
            'nova-markdown'
        );
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
}
