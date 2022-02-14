<?php

namespace App\repositories\Eloquent;

use App\models\Grade;
use App\repositories\GradesRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GradesRepository extends BasicRepository implements GradesRepositoryInterface
{
    public function __construct(Grade $model)
    {
        Parent::__construct($model);
    }



}
