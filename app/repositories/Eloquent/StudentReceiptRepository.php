<?php

namespace App\repositories\Eloquent;

use App\Models\StudentReceipt;
use Illuminate\Database\Eloquent\Model;

class StudentReceiptRepository extends BasicRepository
{
    public function __construct(StudentReceipt $model)
    {
        parent::__construct($model);
    }

}
