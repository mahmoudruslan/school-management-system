<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['grade_id', 'classroom_id', 'section_id', 'admin_id', 'student_id', 'date', 'status'];

    public function students()
    {
        return $this->belongsTo('App\models\Student','student_id');
    }
    public function grades()
    {
        return $this->belongsTo('App\models\Grade','grade_id');
    }
    public function classrooms()
    {
        return $this->belongsTo('App\models\Classroom','classroom_id');
    }
    public function sections()
    {
        return $this->belongsTo('App\models\Section','section_id');
    }
    public function admin()
    {
        return $this->belongsTo('App\models\Admin','admin_id');
    }

}


