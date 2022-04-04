<?php

namespace App\repositories\Eloquent;

use App\models\Promotion;
use App\repositories\PromotionRepositoryInterface;

class PromotionRepository extends BasicRepository implements PromotionRepositoryInterface
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
