<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FeeInvoice extends Model
{
    protected $fillable = ['student_id','date','grade_id','classroom_id','fee_id','amount','description'];
    public $timestamps = true;

    public function students()
    {
        return $this->belongsTo('App\models\Student','student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\models\Fee','fee_id');
    }
}
