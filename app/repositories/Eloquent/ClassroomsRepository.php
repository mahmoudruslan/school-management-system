<?php

namespace App\repositories\Eloquent;

use App\models\Classroom;
use App\models\Section;
use App\repositories\ClassroomsRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClassroomsRepository extends BasicRepository implements ClassroomsRepositoryInterface
{
    public function __construct(Classroom $model)
    {
        Parent::__construct($model);
    }


}
