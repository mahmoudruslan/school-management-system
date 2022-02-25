<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['title' ,'file_name' ,'teacher_id' ,'classroom_id' ,'section_id'];
    public $timestamps = true;
}
