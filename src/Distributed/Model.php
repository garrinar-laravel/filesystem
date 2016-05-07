<?php

namespace Garrinar\Filesystem\Distributed;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{

    protected $fillable = [
        'path',
        'name',
        'old_name',
        'distributed_path'
    ];
    
    public function __construct(array $attributes = [])
    {
        $this->setTable(ServiceProvider::$table);
        parent::__construct($attributes);
    }

}
