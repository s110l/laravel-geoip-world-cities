<?php

namespace Moharrum\LaravelGeoIPWorldCities;

/*
 * \Moharrum\LaravelGeoIPWorldCities for Laravel 4
 *
 * Copyright (c) 2015 - 2016 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class Facade extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return 'cities';
    }
}
