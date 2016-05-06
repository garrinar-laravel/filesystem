<?php

namespace Garrinar\Filesystem\Distributed;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Arr;
use Garrinar\Filesystem\Distributed\Adapter as DistributedAdapter;


class Manager extends FilesystemManager
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