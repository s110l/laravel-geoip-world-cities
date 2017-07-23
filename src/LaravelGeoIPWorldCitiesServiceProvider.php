<?php

namespace S110L\LaravelGeoIPWorldCities;

/*
 * \S110L\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2017 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2017 \S110L\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Support\ServiceProvider;
use S110L\LaravelGeoIPWorldCities\Console\CreateCitiesSeederCommand;
use S110L\LaravelGeoIPWorldCities\Console\CreateCitiesMigrationCommand;
use S110L\LaravelGeoIPWorldCities\Console\CreateRegionsSeederCommand;
use S110L\LaravelGeoIPWorldCities\Console\CreateRegionsMigrationCommand;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class LaravelGeoIPWorldCitiesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->bind();

        $this->mergeConfig();

        $this->registerMigrationCommand();

        $this->registerSeederCommand();
    }

    /**
     * Publish config files.
     */
    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php' => config_path('cities.php'),
            __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'regions_config.php' => config_path('regions.php'),
        ]);
    }

    /**
     * Bind the package to the IoC container.
     */
    private function bind()
    {
        $thisApp = $this->app;

        if(((double) $thisApp::VERSION) === 5.4) {
            $this->app->singleton('cities', function ($app) {
                return new City;
            });

            return;
        }

        $this->app['cities'] = $this->app->share(function ($app) {
            return new City;
        });

        if(((double) $thisApp::VERSION) === 5.4) {
            $this->app->singleton('regions', function ($app) {
                return new Region;
            });

            return;
        }

        $this->app['regions'] = $this->app->share(function ($app) {
            return new Region;
        });
    }

    /**
     * Merges user's and cities's configs.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php',
            'cities'
        );
        
        $this->mergeConfigFrom(
            __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'regions_config.php',
            'regions'
        );
    }

    /**
     * Register the migration command.
     */
    private function registerMigrationCommand()
    {
        $thisApp = $this->app;

        if(((double) $thisApp::VERSION) === 5.4) {
            $this->app->singleton('command.cities.migration', function ($app) {
                return new CreateCitiesMigrationCommand;
            });
        } else {
            $this->app['command.cities.migration'] = $this->app->share(function($app) {
                return new CreateCitiesMigrationCommand;
            });
        }

        $this->commands('command.cities.migration');

        if(((double) $thisApp::VERSION) === 5.4) {
            $this->app->singleton('command.regions.migration', function ($app) {
                return new CreateRegionsMigrationCommand;
            });
        } else {
            $this->app['command.regions.migration'] = $this->app->share(function($app) {
                return new CreateRegionsMigrationCommand;
            });
        }

        $this->commands('command.regions.migration');
    }

    /**
     * Register the seeder command.
     */
    private function registerSeederCommand()
    {
        $thisApp = $this->app;

        if(((double) $thisApp::VERSION) === 5.4) {
            $this->app->singleton('command.cities.seeder', function ($app) {
                return new CreateCitiesSeederCommand;
            });
        } else {
            $this->app['command.cities.seeder'] = $this->app->share(function($app) {
                return new CreateCitiesSeederCommand;
            });
        }

        $this->commands('command.cities.seeder');

        if(((double) $thisApp::VERSION) === 5.4) {
            $this->app->singleton('command.regions.seeder', function ($app) {
                return new CreateRegionsSeederCommand;
            });
        } else {
            $this->app['command.regions.seeder'] = $this->app->share(function($app) {
                return new CreateRegionsSeederCommand;
            });
        }

        $this->commands('command.regions.seeder');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['cities','regions'];
    }
}