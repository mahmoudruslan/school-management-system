<?php

namespace App\repositories\Eloquent;

use App\Models\FeeProcessing;

class FeeProcessingRepository extends BasicRepository
{
    public function __construct(FeeProcessing $model)
    {
        parent::__construct($model);
    }

}
