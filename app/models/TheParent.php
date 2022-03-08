<?php

namespace App\models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TheParent extends Authenticatable
{
    protected $fillable = [
        'father_name_ar',
        'father_name_en',
        'father_national_id',
        'father_phone',
        'father_job_ar',
        'father_job_en',
        'father_nationality_id',
        'mother_name_ar',
        'mother_name_en',
        'mother_national_id',
    ];
    public $timestamps = true;



    public function images()
    {
        return $this->morphMany('App\models\Image', 'imageable');
    }

    // nationalitys
    public function nationality()
    {
        return $this->belongsTo('App\models\Nationality', 'father_nationality_id');
    }

    // religions
    public function attachments()
    {
        return $this->hasMany('App\models\ParentsAttachments', 'parents_id',);
    }
}
