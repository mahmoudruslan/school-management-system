<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
                'student_id',
                'from_grade_id',
                'from_classroom_id',
                'from_section_id',
                'to_grade_id',
                'to_classroom_id',
                'to_section_id',
            ];
    // grades
    public function students(){
        return $this->belongsTo('App\models\Student','student_id');
    }

    // grades
    public function f_grade(){
        return $this->belongsTo('App\models\Grade','from_grade_id');
    }

    // classrooms
    public function f_classroom(){
        return $this->belongsTo('App\models\Classroom','from_classroom_id');
    }

    // sections
    public function f_section(){
        return $this->belongsTo('App\models\Section','from_section_id');
    }

    // grades
    public function to_grade(){
        return $this->belongsTo('App\models\Grade','to_grade_id');
    }

    // classrooms
    public function to_classroom(){
        return $this->belongsTo('App\models\Classroom','to_classroom_id');
    }

    // sections
    public function to_section(){
        return $this->belongsTo('App\models\Section','to_section_id');
    }
}
