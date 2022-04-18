<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SchoolDataRequest extends FormRequest
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

        return  [
            'name_ar' => 'required|max:50',
            'grade' => 'required|max:50',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',

        ];

    }

    public function messages()
    {
        return [
            'name_ar.required' => __('This field is required'),
            'grade.required' => __('This field is required'),
            'phone.required' => __('This field is required'),
            'email.required' => __('This field is required'),
            'address.required' => __('This field is required'),
            'name_ar.max' => __('The name field must be no more than 50 characters'),
            'name_en.max' => __('The name field must be no more than 50 characters'),
        ];
    }




}
