<?php

namespace Garrinar\Filesystem\Distributed;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Arr;
use Garrinar\Filesystem\Distributed\Adapter as LocalAdapter;
use League\Flysystem\AdapterInterface;



class Manager extends FilesystemManager
{
    
    public function createLocalDriver(array $config)
    {
        $permissions = isset($config['permissions']) ? $config['permissions'] : [];

        $links = Arr::get($config, 'links') === 'skip'
            ? LocalAdapter::SKIP_LINKS
            : LocalAdapter::DISALLOW_LINKS;

        return $this->adapt($this->createDistributedFilesystem(new LocalAdapter(
            $config['root'], LOCK_EX, $links, $permissions
        ), $config));
    }

    /**
     * Create a Flysystem instance with the given adapter.
     *
     * @param  \League\Flysystem\AdapterInterface  $adapter
     * @param  array  $config
     * @return \League\Flysystem\FlysystemInterface
     */
    protected function createDistributedFilesystem(AdapterInterface $adapter, array $config)
    {
        $config = Arr::only($config, ['visibility']);

        return new Filesystem($adapter, count($config) > 0 ? $config : null);
    }
}