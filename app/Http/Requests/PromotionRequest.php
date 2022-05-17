<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PromotionRequest extends FormRequest
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
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'section_id' => 'required',
            'to_grade_id' => 'required',
            'to_classroom_id' => 'required',
            'to_section_id' => 'required',
        ];

    }

    public function messages()
    {
        return [

            'from_grade_id.required' => __('This field is required'),
            'from_classroom_id.required' => __('This field is required'),
            'from_section_id.required' => __('This field is required'),
            'to_grade_id.required' => __('This field is required'),
            'to_classroom_id.required' => __('This field is required'),
            'to_section_id.required' => __('This field is required'),


        ];
    }




}
