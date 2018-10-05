<?php

namespace DevA7mad\Annotations;

use Illuminate\Support\ServiceProvider;

class AnnotationsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $this->registerConfig();

        $this->app->register('DevA7mad\Annotations\Providers\CommandsServiceProvider');

        if ($app['config']['annotations.auto_scan'])
            $this->registerAutoScanAnnotations();
    }

    /**
     * Register the config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->app->configure('annotations');
    }

    /**
     * Scan annotations and update routes and event bindings.
     *
     * @return void
     */
    protected function registerAutoScanAnnotations()
    {
        $this->registerAutoScanRouteAnnotations();

        $this->registerAutoScanEventAnnotations();
    }

    /**
     * Auto update routes.
     *
     * @return void
     */
    protected function registerAutoScanRouteAnnotations()
    {
        $app = $this->app;

        // get classes
        $classes = $app['annotations.classfinder']->getClassesFromNamespace($app['config']['annotations.routes_namespace']);

        // build metadata
        $routes = $app['annotations.route.scanner']->scan($classes);

        // generate routes.php file for scanned routes
        $app['annotations.route.generator']->generate($routes);
    }

    /**
     * Auto update event bindings.
     *
     * @return void
     */
    protected function registerAutoScanEventAnnotations()
    {
        $app = $this->app;

        // get classes
        $classes = $app['annotations.classfinder']->getClassesFromNamespace($app['config']['annotations.events_namespace']);

        // build metadata
        $events = $app['annotations.event.scanner']->scan($classes);

        // generate events.php file for scanned routes
        $app['annotations.event.generator']->generate($events);
    }
}
