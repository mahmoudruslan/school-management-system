<?php

namespace App\repositories\Eloquent;


use App\Models\Admin;
use App\repositories\AdminRepositoryInterface;

class AdminRepository extends BasicRepository implements AdminRepositoryInterface
{
    public function __construct(Admin $model)
    {
        Parent::__construct($model);
    }

}
