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

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class CitiesFacade extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return 'cities';
    }
}
