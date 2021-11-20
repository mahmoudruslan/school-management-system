<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'email' => 'required|email',
            'password' => 'required|max:8',
            'name_ar' => 'required|max:50',
            'name_en' => 'required|max:50',
            'address'=> 'required|max:200',
            'joining_date'=> 'required',
            'specialization_id'=> 'required',
            'gender'=> 'required|in:$2y$10$NgiCAwLGJ6yMl/ZDlNmBBu07oegjK1JG9VGiRhdMrmI4VmdzuRQQS,$2y$10$FkGE1UxATWFSWUuRPxqdu.uccMpntdV6r3662YMA.HDyssiNlJdYa',


        ];
    }
    public function messages()
    {
        return [
            'gender.required' => __('messages.This field is required'),
            'specialization_id.required' => __('messages.This field is required'),
            'joining_date.required' => __('messages.This field is required'),
            'email.required' => __('messages.This field is required'),
            'email.email' => __('messages.This field must be an email'),
            'name_ar.required' => __('messages.This field is required'),
            'name_en.required' => __('messages.This field is required'),
            'name_ar.max' => __('messages.This is field must be no more than 50 characters'),

            'name_en.max' => __('messages.This is field must be no more than 50 characters'),
            'password.required' => __('messages.This field is required'),
            'password.max' => __('messages.This is field must be no more than 8 characters'),

            'address.required' => __('messages.This field is required'),
            'address.max' => __('messages.This is field must be no more than 200 characters'),







        ];
    }




}
