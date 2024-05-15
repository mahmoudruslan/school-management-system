<?php

namespace App\repositories\Eloquent;

use App\Models\FeeInvoice;

class FeesInvoiceRepository extends BasicRepository
{
    public function __construct(FeeInvoice $model)
    {
        parent::__construct($model);
    }

}
