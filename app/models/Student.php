<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable
{
    use SoftDeletes;
    protected $guarded = [];
    public $timestamps = true;


    public function setPasswordAttribute($password)
    {
            $this->attributes['password'] = Hash::make($password);
    }

    public function getEntryStatusAttribute($value){
        return $value == '1'? 'Noob' : 'Left to return';
    }

    public function getGenderAttribute($value){
        return $value == '1'? 'Male' : 'Female';
    }


    public function images()
    {
        return $this->morphMany('App\models\Image', 'imageable');
    }




    // nationalities
    public function nationalities(){
        return $this->belongsTo('App\models\Nationality','student_nationality_id');
    }
    // nationalities
    public function bloodTypes(){
        return $this->belongsTo('App\models\BloodType','blood_type_id');
    }
    // grades
    public function grades(){
        return $this->belongsTo('App\models\Grade','grade_id');
    }

    // classrooms
    public function classrooms(){
        return $this->belongsTo('App\models\Classroom','classroom_id');
    }

    // sections
    public function sections(){
        return $this->belongsTo('App\models\Section','section_id');
    }

    // sections
    public function parents(){
        return $this->belongsTo('App\models\TheParent','parent_id');
    }

    // sections
    public function attendances()
    {
        return $this->hasMany('App\models\Attendance', 'student_id');
    }

    }
