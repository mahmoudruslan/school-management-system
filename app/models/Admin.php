<?php

namespace App\models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = ['id', 'name_ar', 'name_en', 'gender', 'email','password','role_id'];
    public $timestamps = true;


    public function setPasswordAttribute($password)
    {
            $this->attributes['password'] = Hash::make($password);
    }
    public function getGenderAttribute($value){
        return $value == '1'? 'Male' : 'Female';
    }

    public function sections(){
        return $this->belongsToMany('App\models\Section','App\models\AdminSection');
    }
    
    public function teacher()
    {
        return $this->hasOne(Teacher::class,'admin_id');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function hasAbility($permissions)
    {
        $role = $this->roles;
        if(!$role){
            return false;
        }

        foreach($role->permissions as $permission)
        {
            if(is_array($permissions) && in_array($permission, $permissions)){
                return true;
            }elseif(is_string($permissions) && strcmp($permissions,$permission) == 0){
                return true;

            }
                
        }
        return false;
    }

}
