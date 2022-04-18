<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentReceipt extends Model
{
    protected $fillable = ['student_id', 'debit', 'description', 'date'];
    public $timestamps = true;

    public function students()
    {
        return $this->belongsTo('App\Models\Student','student_id');
    }
}
