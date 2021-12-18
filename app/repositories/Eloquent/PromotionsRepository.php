<?php

namespace App\repositories\Eloquent;

use App\models\Promotion;
use App\repositories\PromotionsRepositoryInterface;

class PromotionsRepository extends BasicRepository implements PromotionsRepositoryInterface
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
