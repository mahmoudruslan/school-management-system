<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TheParentRequest extends FormRequest
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
            'email'=> 'required|email',
            'name_father_ar'=> 'required|max:100',
            'name_father_en'=> 'required|max:100',
            'national_id_father'=> 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_father'=> 'min:10|max:10',
            'phone_father'=> 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'job_father_ar'=> 'required|max:50',
            'job_father_en'=> 'required|max:50',
            'blood_Type_father_id'=> 'required',
            'nationality_father_id'=> 'required',
            'religion_father_id'=> 'required',
            'address_father'=> 'required|max:200',




        ];
        return $rules;
    }
    public function rules1()
    {
        $x = $this->editRule1();
        return $x += [
            'password'=> 'required|max:8',
        ];
    }


    public function rules2()
    {
        return
            [
                'name_mother_ar'=> 'required|max:100',
                'name_mother_en'=> 'required|max:100',
                'national_id_mother'=> 'required|string|min:10|max:10|regex:/[0-9]{9}/',
                'passport_id_mother'=> 'min:10|max:10',
                'phone_mother'=> 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'job_mother_ar'=> 'required|max:50',
                'job_mother_en'=> 'required|max:50',
                'blood_Type_mother_id'=> 'required',
                'nationality_mother_id'=> 'required',
                'religion_mother_id'=> 'required',
                'address_mother'=> 'required||max:200',
            ];
    }

    public function realTimeValidation()
    {
        return [
            'email'=> 'required|email|unique:the_parents',
            'password'=> 'required|max:8',
            'national_id_father'=> 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_father'=> 'min:10|max:10',
            'phone_father'=> 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'national_id_mother'=> 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_mother'=> 'min:10|max:10',
            'phone_mother'=> 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('This field is required'),
            'email.email' => __('This field must be an email'),
            'name_father_ar.required' => __('This field is required'),
            'name_father_ar.max' => __('This is field must be no more than 100 characters'),
            'name_father_en.required' => __('This field is required'),
            'name_father_en.max' => __('This is field must be no more than 100 characters'),
            'name_mother_ar.required' => __('This field is required'),
            'name_mother_ar.max' => __('This is field must be no more than 100 characters'),
            'name_mother_en.required' => __('This field is required'),
            'name_mother_en.max' => __('This is field must be no more than 100 characters'),
            'password.required' => __('This field is required'),
            'password.max' => __('This is field must be no more than 8 characters'),



            'national_id_father.required' => __('This field is required'),
            'national_id_father.regex' => __('The format is invalid.'),
            'national_id_mother.required' => __('This field is required'),
            'national_id_mother.regex' => __('The format is invalid.'),


            'job_father_ar.required' => __('This field is required'),
            'job_father_ar.max' => __('This is field must be no more than 50 characters'),
            'job_father_en.required' => __('This field is required'),
            'job_father_en.max' => __('This is field must be no more than 50 characters'),

            'job_mother_ar.required' => __('This field is required'),
            'job_mother_ar.max' => __('This is field must be no more than 50 characters'),
            'job_mother_en.required' => __('This field is required'),
            'job_mother_en.max' => __('This is field must be no more than 50 characters'),

            'religion_father_id.required' => __('This field is required'),
            'religion_mother_id.required' => __('This field is required'),
            'blood_Type_father_id.required' => __('This field is required'),
            'blood_Type_mother_id.required' => __('This field is required'),
            'nationality_father_id.required' => __('This field is required'),
            'nationality_mother_id.required' => __('This field is required'),
            'passport_id_father.required' => __('This field is required'),
            'passport_id_father.numeric' => __('It must be numbers'),
            'passport_id_mother.required' => __('This field is required'),
            'passport_id_mother.numeric' => __('It must be numbers'),
            'phone_father.required' => __('This field is required'),
            'phone_father.regex' => __('The format is invalid.'),
            'phone_mother.required' => __('This field is required'),
            'phone_mother.regex' => __('The format is invalid.'),


            'address_father.required' => __('This field is required'),
            'address_father.max' => __('This is field must be no more than 200 characters'),
            'address_mother.required' => __('This field is required'),
            'address_mother.max' => __('This is field must be no more than 200 characters'),


        ];
    }
}
