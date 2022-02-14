<?php

namespace App\repositories\Eloquent;

use App\models\Payment;
use App\repositories\PaymentsRepositoryInterface;

class PaymentsRepository extends BasicRepository implements PaymentsRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

}
