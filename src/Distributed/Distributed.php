<?php

namespace Garrinar\Filesystem\Distributed;



use Illuminate\Filesystem\FilesystemServiceProvider;

class ServiceProvider extends FilesystemServiceProvider
{
    /**
     * Register the filesystem manager.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('filesystem', function () {
            return new Manager($this->app);
        });
    }
}