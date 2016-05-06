<?php
/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 05.05.2016
 * Time: 19:28
 */

namespace Garrinar\Filesystem\ServiceProvider;



use Garrinar\Filesystem\Distributed\Manager\DistributedManager;
use Illuminate\Filesystem\FilesystemServiceProvider;

class DistributedServiceProvider extends FilesystemServiceProvider
{
    /**
     * Register the filesystem manager.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('filesystem', function () {
            return new DistributedManager($this->app);
        });
    }
}