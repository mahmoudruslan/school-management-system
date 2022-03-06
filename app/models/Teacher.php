<?php

namespace App\models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;


class Teacher extends Authenticatable
{
    protected $fillable = ['name_ar', 'name_en', 'password','email','gender','specialization_id','joining_date','address'];
    public $timestamps = true;

    public function getGenderAttribute($value){
        return $value == '1'? 'Male' : 'Female';
    }

    public function setPasswordAttribute($password)
    {
            $this->attributes['password'] = Hash::make($password);
    }

    public function specializations(){
        return $this->belongsTo('App\models\Specialization','specialization_id');
    }

    public function sections(){
        return $this->belongsToMany('App\models\Section','App\models\TeacherSection');
    }
    public function students()
    {
        return $this->hasManyThrough('App\models\Student','App\models\TeacherSection','teacher_id','section_id');
    }
}
