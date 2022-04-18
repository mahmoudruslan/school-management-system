<?php

namespace App\repositories\Eloquent;

use App\Models\Payment;
use App\repositories\PaymentRepositoryInterface;

class PaymentRepository extends BasicRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

}
