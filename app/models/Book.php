<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['title' ,'admin_id' , 'grade_id', 'classroom_id' ,'section_id', 'file_name'];
    public $timestamps = true;

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
    // grades
    public function grade(){
        return $this->belongsTo('App\Models\Grade','grade_id');
    }

    // classrooms
    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','classroom_id');
    }

    // sections
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    // admin
    public function admin(){
        return $this->belongsTo('App\Models\Admin','admin_id');
    }
}
