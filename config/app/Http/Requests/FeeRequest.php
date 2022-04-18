<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
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
            'name_ar' => 'required|max:100',
            'name_en' => 'required|max:100',
            'amount' => 'required',
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'notes' => 'max:200',
            'year' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'name_ar.required' => __('This field is required'),
            'name_en.required' => __('This field is required'),
            'grade_id.required' => __('This field is required'),
            'classroom_id.required' => __('This field is required'),
            'year.required' => __('This field is required'),
            'amount.required' => __('This field is required'),
            'name_ar.max' => __('The name field must be no more than 100 characters'),
            'name_en.max' => __('The name field must be no more than 100 characters'),
            'notes.max' => __('The name field must be no more than 100 characters'),

        ];
    }
}
