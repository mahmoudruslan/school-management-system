<?php

namespace App\repositories\Eloquent;


use App\models\Specialization;
use App\models\Teacher;
use App\repositories\TeachersRepositoryInterface;

class TeachersRepository extends BasicRepository implements TeachersRepositoryInterface
{
    public function __construct(Teacher $model)
    {
        Parent::__construct($model);
    }

}
