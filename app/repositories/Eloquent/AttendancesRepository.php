<?php

namespace App\repositories\Eloquent;

use App\models\Attendance;
use App\repositories\AttendancesRepositoryInterface;

class AttendancesRepository extends BasicRepository implements AttendancesRepositoryInterface
{
    public $model;
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

}
