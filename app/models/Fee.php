<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = ['all_student', 'name_ar', 'name_en', 'amount', 'grade_id', 'classroom_id', 'notes', 'year'];
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
