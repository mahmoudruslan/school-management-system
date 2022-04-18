<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSection extends Model
{
    protected $fillable = ['admin_id', 'section_id'];
    public $timestamps = false;
}
