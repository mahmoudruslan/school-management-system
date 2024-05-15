<?php

namespace App\repositories\Eloquent;


use App\Models\Role;

class RoleRepository extends BasicRepository 
{
    public function __construct(Role $model)
    {
        Parent::__construct($model);
    }

}
