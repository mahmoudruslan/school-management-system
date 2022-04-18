<?php

namespace App\repositories\Eloquent;

use App\Models\StudentAccount;
use App\repositories\StudentAccountRepositoryInterface;

class StudentAccountRepository extends BasicRepository implements StudentAccountRepositoryInterface
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
