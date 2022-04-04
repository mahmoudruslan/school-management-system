<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AdminSection extends Model
{
    protected $fillable = ['admin_id', 'section_id'];
    public $timestamps = false;
}
