<?php

namespace App\repositories\Eloquent;


use App\Models\Admin;

class AdminRepository extends BasicRepository
{
    public function __construct(Admin $model)
    {
        Parent::__construct($model);
    }

}
