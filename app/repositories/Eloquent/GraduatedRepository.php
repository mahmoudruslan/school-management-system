<?php

namespace App\repositories\Eloquent;

use App\models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GraduatedRepository extends BasicRepository implements \App\repositories\GraduatedRepositoryInterface
{
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }

    public function getAll():object
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
