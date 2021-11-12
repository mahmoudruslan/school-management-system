<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;



class Grade extends Model 
{

    protected $table = 'grades';
    public $timestamps = true;
    protected $fillable = array('id','name_ar','name_en', 'notes');

public function sections(){
    return $this ->hasMany('App\models\Section','grade_id');
}

public function classrooms(){
    return $this ->hasMany('App\models\Classroom','grade_id');
}
    

}