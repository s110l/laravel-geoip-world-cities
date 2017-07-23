<?php

namespace S110L\LaravelGeoIPWorldCities\Console;

/*
 * \S110L\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2017 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2017 \S110L\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * @author Lajos Veres <lajos.veres@gmail.com>
 */
class CreateRegionsMigrationCommand extends Command
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'regions:migration';

    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regions:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the regions table migration file.';

    /**
     * @var string The migration file name.
     */
    public $migration_file = '2017_07_23_171615_create_regions_table.php';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $exists = false;

        if (File::exists($this->publishedMigrationRealpath())) {
            $exists = true;

            if (!$this->confirm('The migration file already exists, overwrite it? [Yes|no]')) {
                return $this->info('Okay, no changes made to the file.');
            }
        }

        $inputFile = file_get_contents($this->localMigrationRealpath());

        $outputFile = fopen($this->publishedMigrationRealpath(), 'w');

        if ($inputFile && $outputFile) {
            fwrite($outputFile, $inputFile);

            fclose($outputFile);
        } else {
            File::delete($this->publishedMigrationRealpath());

            return $this->error(
                        'There was an error creating the migration file, '
                        .'check write permissions for ' . base_path('database') . DIRECTORY_SEPARATOR . 'migrations'
                        .PHP_EOL
                        .PHP_EOL
                        .'If you think this is a bug, please submit a bug report '
                        .'at https://github.com/s110l/laravel-geoip-world-cities/issues'
                    );
        }

        if(! $exists) {
            $this->info('Okay, migration file created successfully.');

            return;
        }

        $this->info('Okay, migration file overwritten successfully.');
    }

    /**
     * Returns the full path to the local migration file.
     * 
     * @return string
     */
    protected function localMigrationRealpath()
    {
        return __DIR__
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . 'migrations'
                . DIRECTORY_SEPARATOR
                . $this->migration_file;
    }

    /**
     * Returns the full path to the published migration file.
     * 
     * @return string
     */
    protected function publishedMigrationRealpath()
    {
        return base_path(
                'database'
                . DIRECTORY_SEPARATOR
                . 'migrations'
                . DIRECTORY_SEPARATOR
                . $this->migration_file
            );
    }
}
