<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    
    protected $fillable = [
        'student_id', 
        'admin_id', 
        'subject_id', 
        'grade_id', 
        'classroom_id', 
        'degree', 
        'academic_year', 
        'term'
    ];
    public $timestamps = true;

    // public function getTermAttribute($value){
    //     return $value == '1'? 'First semester' : 'Second semester';
    // }

    public function student(){
        return $this ->belongsTo('App\Models\Student','student_id');
    }
    public function admin(){
        return $this ->belongsTo('App\Models\Admin','admin_id');
    }

    public function subject(){
        return $this ->belongsTo('App\Models\Subject','subject_id');
    }

    public function grade(){
        return $this ->belongsTo('App\Models\Grade','grade_id');
    }

    public function classroom(){
        return $this ->belongsTo('App\Models\Classroom','classroom_id');
    }


}
