<?php

namespace App\repositories\Eloquent;

use App\Models\Classroom;

class ClassroomRepository extends BasicRepository
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
