<?php

namespace App\repositories\Eloquent;

use App\Models\Grade;

class GradeRepository extends BasicRepository
{
    public function __construct(Grade $model)
    {
        Parent::__construct($model);
    }

}
