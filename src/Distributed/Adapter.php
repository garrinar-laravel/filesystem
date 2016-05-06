<?php
/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 06.05.2016
 * Time: 12:15
 */

namespace Garrinar\Filesystem\Distributed;

use League\Flysystem\Adapter\Local;

class Adapter extends Local
{
    public function applyPathPrefix($path)
    {
        $path = $this->applyDistributedPathPrefix($path);
        return $path;
    }

    public function applyDistributedPathPrefix($path)
    {
        return parent::applyPathPrefix($this->getDistributedPrefix($path).$path);
    }

    public function getDistributedPrefix($path)
    {
        $md5FileName = md5($path);
        $prefixes = collect([
            mb_substr($md5FileName, 0, 3),
            mb_substr($md5FileName, 3, 3),
            mb_substr($md5FileName, 6, 3),
        ]);
        $dirPath = '';
        $prefixes->each(function($prefix, $key) use (&$dirPath) {
            $dirPath .= $this->pathSeparator.$prefix;
            $fullPath = parent::getPathPrefix().$dirPath;
            if(!is_dir($fullPath)) {
                @mkdir(parent::getPathPrefix() . $dirPath);
            }
        });

        return $dirPath.$this->pathSeparator;
    }

}