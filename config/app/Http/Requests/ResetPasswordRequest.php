<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
        return [
            'email' => 'required|email',
            'father_national_id' => 'required',
            'new_password' => 'required|max:8',
            'confirm_password' => 'required|max:8',

        ];
    }

    public function messages()
    {
        return[
            'email.required' => __('This field is required'),
            'email.email' => __('This field must be an email'),
            'father_national_id.required' => __('This field is required'),
            'new_password.required' => __('This field is required'),
            'new_password.max' => __('This is field must be no more than 8 characters'),
            'confirm_password.required' => __('This field is required'),
            'confirm_password.max' => __('This is field must be no more than 8 characters'),
        ];
    }
}
