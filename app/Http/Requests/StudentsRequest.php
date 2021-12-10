<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentsRequest extends FormRequest
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
    public function rules()
    {
        $rules =  [
            'email' => 'required|email|unique:students,email,'.$this->id,
            'name_ar' => 'required|string|max:100',
            'name_en' => 'required|max:100',
            'nationality_id'=> 'required|numeric',
            'date_of_birth'=> 'required|date',
            'grade_id'=> 'required|numeric',
            'parent_id'=> 'required|numeric',
            'religion_id'=> 'required|numeric',
            'academic_year'=> 'required',
            'address'=> 'required|max:100',
            'gender'=> 'required',



        ];
        // in update case
        if(!Request::input('id') > '0')
        {
            $rules += [
                'password'=> 'required|max:8',

            ];
        }


        return $rules;

    }

    public function messages()
    {
        return [

            'email.required' => __('This field is required'),
            'email.email' => __('This field must be an email'),
            'email.unique' => __('Invalid email'),
            'name_ar.required' => __('This field is required'),
            'name_en.required' => __('This field is required'),
            'gender.required' => __('This field is required'),
            'name_ar.max' => __('This is field must be no more than 100 characters'),
            'name_en.max' => __('This is field must be no more than 100 characters'),
            'password.required' => __('This field is required'),
            'password.max' => __('This is field must be no more than 8 characters'),

            'nationality_id.required'=> __('This field is required'),
            'nationality_id.numeric'=> __('This field must be numbers'),
            'blood_type_id.required'=> __('This field is required'),
            'blood_type_id.numeric'=> __('This field must be numbers'),
            'date_of_birth.required'=>  __('This field is required'),
            'date_of_birth.date'=>  __('This field must be date'),
            'grade_id.required'=> __('This field is required'),
            'grade_id.numeric'=> __('This field must be numbers'),

            'parent_id.required'=> __('This field is required'),
            'parent_id.numeric'=> __('This field must be numbers'),

            'religion_id.required'=> __('This field is required'),
            'religion_id.numeric'=> __('This field must be numbers'),

            'academic_year.required'=> __('This field is required'),
            'address.required'=> __('This field is required'),
            'address.max' => __('This is field must be no more than 100 characters'),









        ];
    }




}
