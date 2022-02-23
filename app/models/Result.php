<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    
    protected $fillable = [
        'student_id', 
        'teacher_id', 
        'subject_id', 
        'grade_id', 
        'classroom_id', 
        'degree', 
        'academic_year', 
        'from', 
        'term'
    ];
    public $timestamps = true;

    public function getTermAttribute($value){
        return $value == '1'? 'First semester' : 'Second semester';
    }

    public function students(){
        return $this ->belongsTo('App\models\Student','student_id');
    }
    public function teachers(){
        return $this ->belongsTo('App\models\Teacher','teacher_id');
    }

    public function subjects(){
        return $this ->belongsTo('App\models\Subject','subject_id');
    }

    public function grades(){
        return $this ->belongsTo('App\models\Grade','grade_id');
    }

    public function classrooms(){
        return $this ->belongsTo('App\models\Classroom','classroom_id');
    }


}
