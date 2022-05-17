<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    
    protected $fillable = [
                'student_id',
                'grade_id',
                'classroom_id',
                'section_id',
                'to_grade_id',
                'to_classroom_id',
                'to_section_id',
            ];
    // grades
    public function students(){
        return $this->belongsTo('App\Models\Student','student_id');
    }

    // grades
    public function f_grade(){
        return $this->belongsTo('App\Models\Grade','grade_id');
    }

    // classrooms
    public function f_classroom(){
        return $this->belongsTo('App\Models\Classroom','classroom_id');
    }

    // sections
    public function f_section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    // grades
    public function to_grade(){
        return $this->belongsTo('App\Models\Grade','to_grade_id');
    }

    // classrooms
    public function to_classroom(){
        return $this->belongsTo('App\Models\Classroom','to_classroom_id');
    }

    // sections
    public function to_section(){
        return $this->belongsTo('App\Models\Section','to_section_id');
    }
}
