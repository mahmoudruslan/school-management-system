<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Admin extends Authenticatable implements JWTSubject
{
    protected $guarded = [];
    public $timestamps = true;


    public function setPasswordAttribute($password)
    {
            $this->attributes['password'] = Hash::make($password);
    }
    public function getGenderAttribute($value){
        return $value == '1'? 'Male' : 'Female';
    }

    public function sections(){
        return $this->belongsToMany('App\Models\Section','App\Models\AdminSection');
    }
    
    public function teacher()
    {
        return $this->hasOne(Teacher::class,'admin_id');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function specializations(){
        return $this->belongsTo('App\Models\Specialization','specialization_id');
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

        // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
