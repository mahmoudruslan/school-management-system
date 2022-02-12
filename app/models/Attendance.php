<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['grade_id', 'grade_id', 'classroom_id', 'section_id', 'teacher_id', 'student_id', 'date', 'status'];
}
