<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ParentsAttachments extends Model
{
    protected $fillable = ['photos','parents_id'];
    public $timestamps = true;
}
