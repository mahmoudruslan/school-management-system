<?php

namespace App\repositories\Eloquent;


use App\Models\Role;
use App\repositories\RoleRepositoryInterface;

class RoleRepository extends BasicRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        Parent::__construct($model);
    }

}
