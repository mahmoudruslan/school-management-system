<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    protected $fillable = ['id', 'name'];
    public $timestamps = true;
    
}
