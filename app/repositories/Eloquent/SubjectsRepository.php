<?php
namespace App\repositories\Eloquent;

use App\models\Subject;
use App\repositories\Eloquent\BasicRepository;
use App\repositories\SubjectsRepositoryInterface;

class SubjectsRepository extends BasicRepository implements SubjectsRepositoryInterface
{

    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }
}