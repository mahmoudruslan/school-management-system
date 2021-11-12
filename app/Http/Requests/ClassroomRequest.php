<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
        'name_ar' => 'required|max:100',
        'name_ar' => 'required|max:100',
        'grade_id' => 'required',
        ];
    }
    public function messages()
    {
        return [

            'name_ar.required' => __('messages.This field is required'),
            'name_en.required' => __('messages.This field is required'),
            'grade_id.required' => __('messages.This field is required'),
            'name_ar.max' => __('messages.The name field must be no more than 100 characters'),
            'name_en.max' => __('messages.The name field must be no more than 100 characters'),
        
        ];
    }
}
