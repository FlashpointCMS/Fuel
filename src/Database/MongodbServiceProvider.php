<?php

namespace Flashpoint\Fuel\Migrations;

use Illuminate\Database\DatabaseManager;
use Jenssegers\Mongodb\MongodbServiceProvider as MongodbServiceProviderBase;

class MongodbServiceProvider extends MongodbServiceProviderBase
{
    public function register()
    {
        parent::register();

        // Add database driver.
        $this->app->resolving('db', function (DatabaseManager $db) {
            $db->extend('mongodb', function ($config, $name) {
                $config['name'] = $name;
                return new Connection($config);
            });
        });
    }
}