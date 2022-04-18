<?php

namespace App\repositories\Eloquent;

use App\Models\Student;
use App\repositories\GraduatedRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GraduatedRepository extends BasicRepository implements GraduatedRepositoryInterface
{
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }

    public function getData($columns='*'):object
    {
        return $this->model->onlyTrashed()->get();
    }

    
    public function getById($id)
    {
        $model = $this->model->withTrashed()->find($id);
        if(!$model)
        {
            throw new ModelNotFoundException(__('not_found'));
        }
        return $model;
    }


    public function destroy($id):bool
    {
        $model = $this->model->withTrashed()->find($id);
        if(!$model)
        {
            throw new ModelNotFoundException(__('not_found'));
        }
        return $model->forceDelete();

    }
}
