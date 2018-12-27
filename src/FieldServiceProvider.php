<?php
namespace Eminiarts\RelationshipSelector;

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
            Nova::script('relationship-selector', __DIR__ . '/../dist/js/field.js');
            Nova::style('relationship-selector', __DIR__ . '/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind our own FieldController in order to allow Tabs to get the correct fields from tabs
        $this->app->bind('Laravel\Nova\Http\Controllers\FieldController', 'Eminiarts\RelationshipSelector\FieldController');
    }
}
