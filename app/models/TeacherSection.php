<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TeacherSection extends Model
{
    protected $fillable = ['teacher_id', 'section_id'];
    public $timestamps = false;
}
