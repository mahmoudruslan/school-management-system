<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class GeadeRequest extends FormRequest
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
        'name_ar' => 'required|unique:grades|max:100',
        'name_en' => 'required|unique:grades|max:100',
        'notes' => 'max:250'
        ];
    }
    public function messages()
    {
        return [

            'name_ar.required' => __('This field is required'),
            'name_en.required' => __('This field is required'),
            'name_ar.unique' => __('This field must be unique'),
            'name_en.unique' => __('This field must be unique'),
            'name_ar.max' => __('The name field must be no more than 100 characters'),
            'name_en.max' => __('The name field must be no more than 100 characters'),
            'notes.max' => __('The notes field must be no more than 250 characters'),

        ];
    }
}
