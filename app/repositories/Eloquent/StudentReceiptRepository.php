<?php

namespace App\repositories\Eloquent;

use App\models\StudentReceipt;
use App\repositories\StudentReceiptRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class StudentReceiptRepository extends BasicRepository implements StudentReceiptRepositoryInterface
{
    public function __construct(StudentReceipt $model)
    {
        parent::__construct($model);
    }

}
