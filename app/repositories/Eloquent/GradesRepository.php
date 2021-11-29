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
