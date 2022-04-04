<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['title' ,'admin_id' , 'grade_id', 'classroom_id' ,'section_id', 'file_name'];
    public $timestamps = true;

    public function images()
    {
        return $this->morphMany('App\models\Image', 'imageable');
    }
    // grades
    public function grades(){
        return $this->belongsTo('App\models\Grade','grade_id');
    }

    // classrooms
    public function classrooms(){
        return $this->belongsTo('App\models\Classroom','classroom_id');
    }

    // sections
    public function sections(){
        return $this->belongsTo('App\models\Section','section_id');
    }

    // admin
    public function admin(){
        return $this->belongsTo('App\models\Admin','admin_id');
    }
}
