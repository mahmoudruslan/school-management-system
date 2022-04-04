<?php

namespace App\repositories\Eloquent;

use App\models\Grade;
use App\repositories\GradeRepositoryInterface;

class GradeRepository extends BasicRepository implements GradeRepositoryInterface
{
    public function __construct(Grade $model)
    {
        Parent::__construct($model);
    }



}
