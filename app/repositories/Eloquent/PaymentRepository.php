<?php

namespace App\repositories\Eloquent;

use App\Models\Payment;

class PaymentRepository extends BasicRepository
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

}
