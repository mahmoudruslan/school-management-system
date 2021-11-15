<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable = ['name_ar','name_en'];
    public $timestamps = true;

}
