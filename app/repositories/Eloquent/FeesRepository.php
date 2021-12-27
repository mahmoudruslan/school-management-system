<?php

namespace App\repositories\Eloquent;

use App\models\Fee;
use App\repositories\FeesRepositoryInterface;

class FeesRepository extends BasicRepository implements FeesRepositoryInterface
{
    public function __construct(Fee $model)
    {
        parent::__construct($model);
    }
}
