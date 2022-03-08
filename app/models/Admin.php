<?php

namespace App\models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = ['id', 'name_ar', 'name_en', 'gender', 'email','password'];
    protected $hidden = [];
    public $timestamps = true;


    public function setPasswordAttribute($password)
    {
            $this->attributes['password'] = Hash::make($password);
    }
    public function getGenderAttribute($value){
        return $value == '1'? 'Male' : 'Female';
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class,'admin_id');
    }

}
