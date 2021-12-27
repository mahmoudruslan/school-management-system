<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    protected $fillable = ['receipt_id', 'student_id','type','debit','credit','fee_invoice_id','fee_processing_id'];
    public $timestamps = true;

}
