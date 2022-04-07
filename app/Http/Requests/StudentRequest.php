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

    public function editRule1(){
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
    public function rules1()
    {
        $x = $this->editRule1();
        return $x
         += [
            'classroom_id' => 'required',
            'section_id' => 'required',
        //     'password'=> 'required|max:8',
        ];
    }


    public function rules2()
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
                // 'national_id_mother'=> 'required|string|min:10|max:10|regex:/[0-9]{9}/',
                // 'passport_id_mother'=> 'min:10|max:10',
                // 'job_mother_ar'=> 'required|max:50',
                // 'job_mother_en'=> 'required|max:50',
                // 'blood_Type_mother_id'=> 'required',
                // 'nationality_mother_id'=> 'required',
                // 'religion_mother_id'=> 'required',
                // 'address_mother'=> 'required||max:200',
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

    public function messages()
    {
        return [

            'name_ar.required' => __('This field is required'),
            'name_en.required' => __('This field is required'),
            'grade_id.required' => __('This field is required'),
            'classroom_id.required' => __('This field is required'),
            'section_id.required' => __('This field is required'),
            'student_nationality_id.required' => __('This field is required'),
            'student_blood_type_id.required' => __('This field is required'),
            'religion.required' => __('This field is required'),
            'date_of_birth.required' => __('This field is required'),
            'date_of_birth.date' => __('This field must be a date'),
            'student_address.required' => __('This field is required'),
            'gender.required' => __('This field is required'),

            // 'entry_status.max' => __('This is field must be no more than 8 characters'),
            'email.required' => __('This field is required'),
            'email.email' => __('This field must be an email'),
            'email.unique' => __('A user with this email address already exists.'),
            'father_name_ar.required' => __('This field is required'),
            'father_name_ar.max' => __('This is field must be no more than 100 characters'),
            'father_name_en.required' => __('This field is required'),
            'father_name_en.max' => __('This is field must be no more than 100 characters'),
            'mother_name_ar.required' => __('This field is required'),
            'mother_name_ar.max' => __('This is field must be no more than 100 characters'),
            'mother_name_en.required' => __('This field is required'),
            'mother_name_en.max' => __('This is field must be no more than 100 characters'),
            'password.required' => __('This field is required'),
            'password.max' => __('This is field must be no more than 8 characters'),



            'father_national_id.required' => __('This field is required'),
            'father_national_id.regex' => __('The format is invalid.'),
            'father_national_id.required' => __('This field is required'),
            'father_national_id.regex' => __('The format is invalid.'),
            'father_national_id.max' => __('This is field must be no more than 14 number'),
            'father_national_id.min' => __('This field must be at least 14 number'),

            'mother_national_id.required' => __('This field is required'),
            'mother_national_id.regex' => __('The format is invalid.'),
            'mother_national_id.required' => __('This field is required'),
            'mother_national_id.regex' => __('The format is invalid.'),
            'mother_national_id.max' => __('This is field must be no more than 14 number'),
            'mother_national_id.min' => __('This field must be at least 14 number'),


            'father_job_ar.required' => __('This field is required'),
            'father_job_ar.max' => __('This is field must be no more than 50 characters'),
            'father_job_en.required' => __('This field is required'),
            'father_job_en.max' => __('This is field must be no more than 50 characters'),

            'father_nationality_id.required' => __('This field is required'),
            'father_phone.required' => __('This field is required'),
            'father_phone.max' => __('This is field must be no more than 20 number'),
            'father_phone.min' => __('This field must be at least 6 number'),



        ];
    }
}
