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
            'name_ar' => 'required|max:50',
            'name_en' => 'required|max:50',
            'email' => 'required|email|unique:admins',
            'password'=> 'required|max:200',
            'gender'=> 'required',
            'role_id'=> 'required',
            'phone'=> 'required',
            'specialization_id'=> 'required',
            'joining_date'=> 'required',
            'address'=> 'required',
            'religion'=> 'required',
            'note'=> 'nullable',
        ];
        // in update case
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $id = $this->route('admin');
            $rules = [
                'name_ar' => 'required|max:50',
                'name_en' => 'required|max:50',
                'email' => 'required|email|unique:admins,email,' . $id,
                'password'=> 'nullable|max:200',
                'phone'=> 'required',
                'specialization_id'=> 'required',
                'joining_date'=> 'required',
                'address'=> 'required',
                'note'=> 'nullable',
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
            'email.unique' => __('This email already exist'),
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
