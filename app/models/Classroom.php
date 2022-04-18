<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Classroom extends Model
{
    protected $table = 'classrooms';

    protected $fillable = array('id','name_ar','name_en', 'grade_id');
    public $timestamps = true;




    public function grades()
    {
        return $this->belongsTo('App\Models\Grade','grade_id');
    }

    public function sections()
    {
        return $this->hasMany('App\Models\Section','classroom_id');
    }


}
