<?php
namespace App\repositories\Eloquent;

use App\Models\Result;

class ResultRepository extends BasicRepository {

    public function __construct(Result $model)
    {
        parent::__construct($model);
    }
}