<?php

namespace App\repositories\Eloquent;

use App\models\StudentAccount;
use App\repositories\StudentAccountsRepositoryInterface;

class StudentAccountsRepository extends BasicRepository implements StudentAccountsRepositoryInterface
{
    public function __construct(StudentAccount $model)
    {
        parent::__construct($model);
    }

    public function where($column, $val)
    {
        return $this->model->where($column,$val);
    }
}
