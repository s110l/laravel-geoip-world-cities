<?php

/*
 * \S110L\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2017 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2017 \S110L\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use S110L\LaravelGeoIPWorldCities\Helpers\Config;

/**
 * @author Lajos Veres <lajos.veres@gmail.com>
 */
class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Config::regionsTableName(), function (Blueprint $table) {
            $table->increments('id');
            
            $table->char('country', 2)
                    ->nullable();
            
            $table->char('region', 2)
                    ->nullable();
            
            $table->string('name')
                    ->nullable()
                    ->collation('utf8_unicode_ci');
            
            $table->index('country', 'idx_country');
            
            $table->index('region', 'idx_region');
            
            $table->index('name', 'idx_name');
            
            $table->timestamps = false;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Config::regionsTableName());
    }
}