<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['id', 'name', 'email','password'];
    protected $hidden = [];
    public $timestamps = true;
}
