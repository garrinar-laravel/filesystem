<?php

namespace Garrinar\Filesystem\Distributed;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public function __construct(array $attributes = [])
    {
        $this->setTable(ServiceProvider::$table);
        parent::__construct($attributes);
    }

}
