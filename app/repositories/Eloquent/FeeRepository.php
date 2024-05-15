<?php

namespace App\repositories\Eloquent;

use App\Models\Fee;

class FeeRepository extends BasicRepository
{
    public function __construct(Fee $model)
    {
        parent::__construct($model);
    }

}
