<?php

namespace App\repositories\Eloquent;

use App\models\Classroom;
use App\models\Section;
use App\repositories\ClassroomRepositoryInterface;

class ClassroomRepository extends BasicRepository implements ClassroomRepositoryInterface
{
    public function __construct(Classroom $model)
    {
        Parent::__construct($model);
    }


    public function getRelated($id)
    {
        return $this->model->where('classroom_id',$id)->pluck('classroom_id');
    }

}
