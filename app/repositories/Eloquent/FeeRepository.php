<?php

namespace App\repositories\Eloquent;

use App\models\Fee;
use App\repositories\FeeRepositoryInterface;

class FeeRepository extends BasicRepository implements FeeRepositoryInterface
{
    public function __construct(Fee $model)
    {
        parent::__construct($model);
    }

}
