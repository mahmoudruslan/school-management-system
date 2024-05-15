<?php

namespace App\repositories\Eloquent;

use App\Models\StudentAccount;

class StudentAccountRepository extends BasicRepository
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
