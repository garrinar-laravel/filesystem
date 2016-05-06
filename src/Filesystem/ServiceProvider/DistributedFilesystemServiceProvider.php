<?php
/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 05.05.2016
 * Time: 19:28
 */

namespace Garrinar\Filesystem\ServiceProvider;

use Garrinar\Filesystem\Adapter\DistributedFilesystemAdapter;
use Garrinar\Filesystem\Driver\DistributedFilesystemDriver;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Filesystem\FilesystemManager as Storage;
use League\Flysystem\File;
use League\Flysystem\Filesystem;

class DistributedFilesystemServiceProvider extends FilesystemServiceProvider
{
    public function boot()
    {
//        Storage::extend('distributed', function($app, $config) {
//
//            $driver = new DistributedFilesystemDriver($config);
//            return new Filesystem(new DistributedFilesystemAdapter());
//        });
    }

    protected function registerFlysystem()
    {
        $this->registerManager();

        $this->app->singleton('filesystem.disk', function () {
            dd($this->app['filesystem']->disk($this->getDefaultDriver()));
            return $this->app['filesystem']->disk($this->getDefaultDriver());
        });

        $this->app->singleton('filesystem.cloud', function () {
            return $this->app['filesystem']->disk($this->getCloudDriver());
        });
    }

    public function registerDistributedFilesystem()
    {
        
    }

    
    public function register()
    {
        parent::register();
        
        $this->registerDistributedFilesystem();
    }
}