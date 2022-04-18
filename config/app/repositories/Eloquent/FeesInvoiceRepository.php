<?php

namespace App\repositories\Eloquent;

use App\Models\FeeInvoice;
use App\repositories\FeesInvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FeesInvoiceRepository extends BasicRepository implements FeesInvoiceRepositoryInterface
{
    public function __construct(FeeInvoice $model)
    {
        parent::__construct($model);
    }

}
