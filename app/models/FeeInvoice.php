<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeInvoice extends Model
{
    protected $fillable = ['student_id','date','grade_id','classroom_id','fee_id','amount','description'];
    public $timestamps = true;

    public function setDateAttribute($value)
    {
            return $this->attributes['date'] = date('y-m-d');
    }
    public function students()
    {
        return $this->belongsTo('App\Models\Student','student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Models\Fee','fee_id');
    }
}
