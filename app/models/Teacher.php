<?php

namespace App\models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
{
    protected $fillable = ['admin_id','phone','specialization_id','joining_date','address','religion','note'];
    public $timestamps = true;



    public function specializations(){
        return $this->belongsTo('App\models\Specialization','specialization_id');
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }

    
}
