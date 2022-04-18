<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['grade_id', 'classroom_id', 'section_id', 'admin_id', 'student_id', 'date', 'status'];

    public function students()
    {
        return $this->belongsTo('App\Models\Student','student_id');
    }
    public function grades()
    {
        return $this->belongsTo('App\Models\Grade','grade_id');
    }
    public function classrooms()
    {
        return $this->belongsTo('App\Models\Classroom','classroom_id');
    }
    public function sections()
    {
        return $this->belongsTo('App\Models\Section','section_id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin','admin_id');
    }

}


