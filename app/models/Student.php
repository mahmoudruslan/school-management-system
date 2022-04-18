<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\StudentFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public $timestamps = true;


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function getEntryStatusAttribute($value)
    {
        return $value == 'Noob' || $value == 1 ? 'Noob' : 'Left to return';
    }

    public function getGenderAttribute($value)
    {
        return $value == '1' || $value == 'Male' ? 'Male' : 'Female';
    }


    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    // nationalities
    public function nationalities()
    {
        return $this->belongsTo('App\Models\Nationality', 'student_nationality_id');
    }
    // nationalities
    public function bloodTypes()
    {
        return $this->belongsTo('App\Models\BloodType', 'student_blood_type_id');
    }
    // grades
    public function grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    // classrooms
    public function classrooms()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id');
    }

    // sections
    public function sections()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    // parents
    public function parents()
    {
        return $this->belongsTo('App\Models\TheParent', 'parent_id');
    }

    // attendances
    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance', 'student_id');
    }

    // studentAccount
    public function studentAccount()
    {
        return $this->hasMany('App\Models\StudentAccount', 'student_id');
    }

    // invoices
    public function invoices()
    {
        return $this->hasMany('App\Models\FeeInvoice', 'student_id');
    }

        // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
