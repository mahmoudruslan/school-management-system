<?php

namespace App\repositories\Eloquent;

use App\models\FeeInvoice;
use App\repositories\FeesInvoicesRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FeesInvoicesRepository extends BasicRepository implements FeesInvoicesRepositoryInterface
{
    public function __construct(FeeInvoice $model)
    {
        parent::__construct($model);
    }

}
