<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'grade_id', 'classroom_id', 'teacher_id'];
    public $timestamps = true;

        // grades
        public function grades(){
            return $this->belongsTo('App\models\Grade','grade_id');
        }
    
        // classrooms
        public function classrooms(){
            return $this->belongsTo('App\models\Classroom','classroom_id');
        }
        
        // teachers
        public function teachers(){
            return $this->belongsTo('App\models\Teacher','teacher_id');
        }


}
