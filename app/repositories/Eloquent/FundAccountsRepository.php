<?php

namespace App\repositories\Eloquent;

use App\models\FundAccount;
use App\repositories\FundAccountsRepositoryInterface;

class FundAccountsRepository extends BasicRepository implements FundAccountsRepositoryInterface
{
    public function __construct(FundAccount $model)
    {
        parent::__construct($model);
    }

}
