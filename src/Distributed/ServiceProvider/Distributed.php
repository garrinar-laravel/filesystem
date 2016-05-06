<?php

namespace Garrinar\Filesystem\Distributed\ServiceProvider;



use Garrinar\Filesystem\Distributed\Manager\DistributedManager;
use Illuminate\Filesystem\FilesystemServiceProvider;

class Distributed extends FilesystemServiceProvider
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