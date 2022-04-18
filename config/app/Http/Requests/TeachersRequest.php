<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TeachersRequest extends FormRequest
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
            'email' => 'required|email',
            'name_ar' => 'required|max:50',
            'name_en' => 'required|max:50',
            'address'=> 'required|max:200',
            'joining_date'=> 'required',
            'phone'=> 'required',
            'role_id'=> 'required',
            'religion'=> 'required',
            


        ];
        // in update case
        if(!Request::input('id') > '0')
        {
            $rules += [
                'password' => 'required|max:8',
                'gender'=> 'required|in:1,0',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'gender.required' => __('This field is required'),
            'role_id.required' => __('This field is required'),
            'religion.required' => __('This field is required'),
            'joining_date.required' => __('This field is required'),
            'email.required' => __('This field is required'),
            'email.email' => __('This field must be an email'),
            'name_ar.required' => __('This field is required'),
            'name_en.required' => __('This field is required'),
            'phone.required' => __('This field is required'),
            'name_ar.max' => __('This is field must be no more than 50 characters'),

            'name_en.max' => __('This is field must be no more than 50 characters'),
            'password.required' => __('This field is required'),
            'password.max' => __('This is field must be no more than 8 characters'),

            'address.required' => __('This field is required'),
            'address.max' => __('This is field must be no more than 200 characters'),







        ];
    }




}
