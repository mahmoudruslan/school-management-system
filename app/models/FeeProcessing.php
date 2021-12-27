<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FeeProcessing extends Model
{
    protected $fillable = ['date', 'student_id', 'amount', 'description'];
    public $timestamps = true;
    public function students()
    {
        return $this->belongsTo('App\models\Student','student_id');
    }
}
