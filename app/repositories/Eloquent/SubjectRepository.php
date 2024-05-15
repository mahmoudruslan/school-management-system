<?php
namespace App\repositories\Eloquent;

use App\Models\Subject;
use App\repositories\Eloquent\BasicRepository;

class SubjectRepository extends BasicRepository
{

    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }
}