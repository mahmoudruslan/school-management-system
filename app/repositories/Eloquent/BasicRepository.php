<?php

namespace App\repositories\Eloquent;

use App\models\Grade;
use App\repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BasicRepository implements EloquentRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getData($columns='*'):object
    {
        return $this->model->all($columns);
    }

    // public function thisModel():object
    // {
    //     return $this->model;
    // }


    public function create(array $attributes)
    {

        return $this->model->create($attributes);
    }



    public function getById($id)
    {
        $model = $this->model->find($id);
        if(!$model)
        {
            throw new ModelNotFoundException(__('not_found'));
        }
        return $model;
    }


    public function update(array $attributes,int $id):object
    {
        $model = $this->model->find($id);
        if(!$model)
        {
            throw new ModelNotFoundException(__('not_found'));
        }
        $model->update($attributes);
        return $model;
    }


    public function destroy($id):bool
    {
        $model = $this->model->find($id);
        if(!$model)
        {
            throw new ModelNotFoundException(__('not_found'));
        }
        return $model->delete();

    }
}
