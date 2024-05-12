<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

protected $fillable = ['id','name_ar','name_en','grade_id','status','classroom_id'];
public $timestamps =  true;


    public function getStatusAttribute($value){
        return $value == '1'? 'Active' : 'Not Active';
    }
    public function students(){
        return $this ->hasMany('App\Models\Student','section_id');
    }

    public function grade(){
        return $this ->belongsTo('App\Models\Grade','grade_id');
    }

    public function classroom(){
        return $this ->belongsTo('App\Models\Classroom','classroom_id');
    }

    public function admins(){
        return $this->belongsToMany('App\Models\Admin','App\Models\AdminSection');
    }
}
