<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function createStep1(){
        $rules =  [
            'name_ar' => 'required|max:100',
            'name_en' => 'required|max:100',
            'grade_id' => 'required',

            'student_nationality_id' => 'required',
            'religion' => 'required',
            'date_of_birth' => 'required|date',
            'student_address' => 'required|max:200',
            'gender' => 'required',

        ];
        return $rules;
    }
    public function editStep1()
    {
        $step1_rule = $this->createStep1();
        return $step1_rule
         += [
            'classroom_id' => 'required',
            'section_id' => 'required',
        ];
    }


    public function editStep2()
    {
        return
            [
            'email'=> 'required|email',
            'father_name_ar'=> 'required|max:100',
            'father_name_en'=> 'required|max:100',
            'father_national_id'=> 'required|min:14|max:14|',
            'mother_national_id'=> 'required|min:14|max:14|',
            'father_phone'=> 'required|min:6|max:20',
            'father_job_ar'=> 'required|max:50',
            'father_job_en'=> 'required|max:50',
            'father_nationality_id'=> 'required',
            'father_job_ar'=> 'required|max:50',
            'father_job_en'=> 'required|max:50',
                'mother_name_ar'=> 'required|max:100',
                'mother_name_en'=> 'required|max:100',
            ];
    }

    public function createStep2()
    {
        $edit_step2 = $this->editStep2();
        return $edit_step2 +=
            [
                'password'=> 'required|max:8',
            ];
    }

    public function realTimeValidation()
    {
        return [
            'email'=> 'required|email|unique:students',
            'password'=> 'required|max:8',
            'father_national_id'=> 'required|min:14|max:14|regex:/[0-9]{9}/',
            'mother_national_id'=> 'required|min:14|max:14|regex:/[0-9]{9}/',
            'father_phone'=> 'min:6|max:20|required',
            'name_ar' => 'required|max:100',
            'name_en' => 'required|max:100',
            'date_of_birth' => 'required|date',

        ];
    }
}
