<?php
namespace App\repositories\Eloquent;

use App\models\Result;
use App\repositories\ResultRepositoryInterface;

class ResultRepository extends BasicRepository implements ResultRepositoryInterface{

    public function __construct(Result $model)
    {
        parent::__construct($model);
    }
}