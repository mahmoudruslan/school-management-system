<?php

namespace App\repositories\Eloquent;

use App\models\FeeProcessing;
use App\repositories\FeeProcessingRepositoryInterface;

class FeeProcessingRepository extends BasicRepository implements FeeProcessingRepositoryInterface
{
    public function __construct(FeeProcessing $model)
    {
        parent::__construct($model);
    }
}
