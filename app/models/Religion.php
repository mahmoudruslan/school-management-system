<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $fillable = ['id','name_ar','name_en'];
    public $timestamps = true;

}
