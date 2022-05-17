<?php

namespace App\repositories\Eloquent;

use App\Models\Grade;
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

    public function getData($columns = '*'): object
    {
        return $this->model->all($columns);
    }

    public function myModel(): object
    {
        return $this->model;
    }


    public function create(array $attributes)
    {
        try {
            $create = $this->model->create($attributes);
            toastr()->success(__('Data saved successfully'));
            return $create;
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function getById($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            throw new ModelNotFoundException(__('Item not found'));
        }
        return $model;
    }


    public function update(array $attributes, int $id): object
    {
        try {
            $model = $this->model->find($id);
            if (!$model) {
                throw new ModelNotFoundException(__('Item not found'));
            }
            $model->update($attributes);
            toastr()->success(__('Data updated successfully'));
            return $model;
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {

            $model = $this->model->find($id);
            if (!$model) {
                throw new ModelNotFoundException(__('Item not found'));
            }
            toastr()->success(__('Data deleted successfully'));

            return $model->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
