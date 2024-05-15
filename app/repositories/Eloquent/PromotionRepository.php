<?php

namespace App\repositories\Eloquent;

use App\Models\Promotion;

class PromotionRepository extends BasicRepository
{
    public function __construct(Promotion $model)
    {
        parent::__construct($model);
    }
    
    public function create(array $attributes)
    {
        return $this->model->updateOrCreate($attributes);
    }


}
