<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;


class Classroom extends Model
{
    protected $table = 'classrooms';

    protected $fillable = array('id','name_ar','name_en', 'grade_id');
    public $timestamps = true;




    public function gradess()
    {
        return $this->belongsTo('App\models\Grade','grade_id');
    }

    public function sections()
    {
        return $this->hasMany('App\models\Section','classroom_id');
    }


}
