<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'grade_id', 'classroom_id', 'degree'];
    public $timestamps = true;

        // grades
        public function grades(){
            return $this->belongsTo('App\Models\Grade','grade_id');
        }
    
        // classrooms
        public function classrooms(){
            return $this->belongsTo('App\Models\Classroom','classroom_id');
        }

}
