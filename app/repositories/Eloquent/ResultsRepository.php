<?php
namespace App\repositories\Eloquent;

use App\models\Result;
use App\repositories\ResultsRepositoryInterface;

class ResultsRepository extends BasicRepository implements ResultsRepositoryInterface{

    public function __construct(Result $model)
    {
        parent::__construct($model);
    }
}