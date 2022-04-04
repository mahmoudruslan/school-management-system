<?php

namespace App\repositories\Eloquent;

use App\models\ExamTimetable;
use App\repositories\ExamsTimetableRepositoryInterface;

class ExamsTimetableRepository extends BasicRepository implements ExamsTimetableRepositoryInterface
{
    public function __construct(ExamTimetable $model)
    {
        Parent::__construct($model);
    }


}