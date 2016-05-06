<?php

namespace Garrinar\Filesystem\Distributed\Manager;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Arr;
use League\Flysystem\Adapter\Local as LocalAdapter;

/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 06.05.2016
 * Time: 11:58
 */
class DistributedManager extends FilesystemManager
{
    /**
     * Create an instance of the local driver.
     *
     * @param  array  $config
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    public function createLocalDriver(array $config)
    {
        $permissions = isset($config['permissions']) ? $config['permissions'] : [];

        $links = Arr::get($config, 'links') === 'skip'
            ? LocalAdapter::SKIP_LINKS
            : LocalAdapter::DISALLOW_LINKS;

        return $this->adapt($this->createFlysystem(new LocalAdapter(
            $config['root'], LOCK_EX, $links, $permissions
        ), $config));
    }
}