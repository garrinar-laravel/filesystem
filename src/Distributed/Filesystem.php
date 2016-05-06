<?php

namespace Garrinar\Filesystem\Distributed;

use Symfony\Component\Finder\Finder;
use League\Flysystem\Filesystem as FlySystem;
use League\Flysystem\AdapterInterface;

class Filesystem extends FlySystem
{
    /**
     * Constructor.
     *
     * @param AdapterInterface $adapter
     * @param Config|array $config
     */
    public function __construct(AdapterInterface $adapter, $config = null)
    {
        parent::__construct($adapter, $config);
    }
}
