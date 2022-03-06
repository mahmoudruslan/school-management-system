<?php

namespace App\models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TheParent extends Authenticatable
{
    protected $guarded = [];
    public $timestamps = true;


    public function setPasswordAttribute($password)
    {
            $this->attributes['password'] = Hash::make($password);
    }
    
    public function images()
    {
        return $this->morphMany('App\models\Image', 'imageable');
    }

    // religions
    public function fatherReligions(){
        return $this->belongsTo('App\models\Religion','religion_father_id');
    }
    public function motherReligions(){
        return $this->belongsTo('App\models\Religion','religion_mother_id');
    }
    // bloodtypes
    public function fatherBloodType(){
        return $this->belongsTo('App\models\BloodType','blood_Type_father_id');
    }
    public function motherBloodType(){
        return $this->belongsTo('App\models\BloodType','blood_Type_mother_id');
    }
    // nationalitys
    public function fatherNationality(){
        return $this->belongsTo('App\models\Nationality','nationality_father_id');
    }
    public function motherNationality(){
        return $this->belongsTo('App\models\Nationality','nationality_mother_id');
    }

    // religions
    public function attachments(){
        return $this->hasMany('App\models\ParentsAttachments','parents_id',);
    }
}
