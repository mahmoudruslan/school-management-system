<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeProcessing extends Model
{
    protected $fillable = ['date', 'student_id', 'amount', 'description'];
    public $timestamps = true;
    public function students()
    {
        return $this->belongsTo('App\Models\Student','student_id');
    }
}
