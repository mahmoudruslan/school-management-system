<?php
namespace App\repositories\Eloquent;

use App\Models\Subject;
use App\repositories\Eloquent\BasicRepository;
use App\repositories\SubjectRepositoryInterface;

class SubjectRepository extends BasicRepository implements SubjectRepositoryInterface
{

    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }
}