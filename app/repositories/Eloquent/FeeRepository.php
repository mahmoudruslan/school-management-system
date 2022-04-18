<?php

namespace App\repositories\Eloquent;

use App\Models\Fee;
use App\repositories\FeeRepositoryInterface;

class FeeRepository extends BasicRepository implements FeeRepositoryInterface
{
    public function __construct(Fee $model)
    {
        parent::__construct($model);
    }

}
