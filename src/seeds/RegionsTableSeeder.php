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

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use S110L\LaravelGeoIPWorldCities\Helpers\Config;

/**
 * @author Lajos Veres <lajos.veres@gmail.com>
 */
class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->dumpFiles() as $dumpPart) {

            $query = "LOAD DATA LOCAL INFILE '"
                    . str_replace('\\', '/', $dumpPart) . "'
                    INTO TABLE `" . Config::regionsTableName() . "` 
                        FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"'
                        LINES TERMINATED BY '\n' IGNORE 1 LINES
                        (country,
                        region,
                        name
                    )";

            DB::connection()->getpdo()->exec($query);

        }
    }

    /**
     * Returns an array containing the full path to each dump file.
     * 
     * @return array
     */
    private function dumpFiles()
    {
        $files = [];

        foreach(File::allFiles(Config::dumpPath()) as $dumpFile) {
            if ( substr( File::basename( $file = $dumpFile->getRealpath() ), 0, 1 ) !== 'r' ) {
                continue;
            }
            $files[] = $file();
        }

        sort($files);

        return $files;
    }
}
