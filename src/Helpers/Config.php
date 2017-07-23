<?php

namespace S110L\LaravelGeoIPWorldCities\Helpers;

/*
 * \S110L\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2017 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2017 \S110L\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class Config
{
    /**
     * Returns the cities table name from config files.
     * 
     * @return string
     */
    public static function citiesTableName()
    {
        return config('cities.table');
    }

    /**
     * Returns the regions table name from config files.
     * 
     * @return string
     */
    public static function regionsTableName()
    {
        return config('regions.table');
    }

    /**
     * Returns the full path to the dump file(s).
     * 
     * @return string
     */
    public static function dumpPath()
    {
        return __DIR__
                .DIRECTORY_SEPARATOR
                .'..'
                .DIRECTORY_SEPARATOR
                .'dump'
                .DIRECTORY_SEPARATOR;
    }
}
