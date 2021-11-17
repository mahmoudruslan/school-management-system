<?php

namespace App\models;


use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name_ar', 'name_en','email','gender','specialization_id','joining_date','address'];
    public $timestamps = true;


    public function specializations(){
        return $this->belongsTo('App\models\Specialization','specialization_id');
    }

    public function sections(){
        return $this->belongsToMany('App\models\Section','App\models\TeacherSection');
    }
}
