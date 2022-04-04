<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

protected $fillable = ['id','name_ar','name_en','grade_id','status','classroom_id'];
public $timestamps =  true;


    public function getStatusAttribute($value){
        return $value == '1'? 'Active' : 'Not Active';
    }
    public function students(){
        return $this ->hasMany('App\models\Student','section_id');
    }

    public function grades(){
        return $this ->belongsTo('App\models\Grade','grade_id');
    }

    public function classrooms(){
        return $this ->belongsTo('App\models\Classroom','classroom_id');
    }

    public function admins(){
        return $this->belongsToMany('App\models\Admin','App\models\AdminSection');
    }
}
