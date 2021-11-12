<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    
protected $fillable = ['id','name_ar','name_en','grade_id','status','classroom_id'];
public $timestamps =  true;


    public function classrooms(){
        return $this ->belongsTo('App\models\Classroom','classroom_id');
    }
}
