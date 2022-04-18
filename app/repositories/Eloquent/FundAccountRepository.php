<?php

namespace App\repositories\Eloquent;

use App\Models\FundAccount;
use App\repositories\FundAccountRepositoryInterface;

class FundAccountRepository extends BasicRepository implements FundAccountRepositoryInterface
{
    public function __construct(FundAccount $model)
    {
        parent::__construct($model);
    }

}
