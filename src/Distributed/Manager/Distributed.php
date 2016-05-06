<?php

namespace Garrinar\Filesystem\Distributed\Manager;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Arr;
use Garrinar\Filesystem\Distributed\Adapter\Distributed as DistributedAdapter;


class DistributedManager extends FilesystemManager
{
    
    public function createDistributedDriver(array $config)
    {
        $permissions = isset($config['permissions']) ? $config['permissions'] : [];

        $links = Arr::get($config, 'links') === 'skip'
            ? DistributedAdapter::SKIP_LINKS
            : DistributedAdapter::DISALLOW_LINKS;

        return $this->adapt($this->createFlysystem(new DistributedAdapter(
            $config['root'], LOCK_EX, $links, $permissions
        ), $config));
    }
}