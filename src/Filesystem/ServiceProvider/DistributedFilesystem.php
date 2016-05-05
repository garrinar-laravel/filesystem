<?php
/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 05.05.2016
 * Time: 19:28
 */

namespace Garrinar\Filesystem\ServiceProvider;

use Garrinar\Filesystem\Adapter\DistributedFilesystemAdapter;
use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class DistributedFilesystem extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('distributed', function($app, $config) {
            return new Filesystem(new DistributedFilesystemAdapter());
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}