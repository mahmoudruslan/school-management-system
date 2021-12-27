<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    protected $fillable = ['date', 'receipt_id', 'debit', 'credit', 'description'];
    public $timestamps = true;
}
