<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'permissions'];
    public $timestamps = true;

    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions,true);
    }

    public function setPermissionsAttribute($permissions)
    {
        $this->attributes['permissions'] = json_encode($permissions,true);
    }
}
