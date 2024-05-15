<?php

namespace App\repositories\Eloquent;

use App\Models\FundAccount;

class FundAccountRepository extends BasicRepository
{
    public function __construct(FundAccount $model)
    {
        parent::__construct($model);
    }

}
