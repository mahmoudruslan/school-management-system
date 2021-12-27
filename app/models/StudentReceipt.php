<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StudentReceipt extends Model
{
    protected $fillable = ['student_id', 'debit', 'description'];
    public $timestamps = true;

    public function students()
    {
        return $this->belongsTo('App\models\Student','student_id');
    }
}
