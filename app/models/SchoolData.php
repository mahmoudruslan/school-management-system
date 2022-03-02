<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SchoolData extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'school_time',
        'school_rating',
        'year_founded',
        'grade',
        'phone',
        'email',
        'school_manager',
        'city',
        'address',
        'logo'
    ];

    // public function setLogoAttribute($value){ 

    //     $x = time() . Str::random(6) . '.' .$value->getClientOriginalExtension();
    //     return $value = $x;
    // } 
}
