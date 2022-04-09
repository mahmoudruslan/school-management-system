<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GraduatedRequest extends FormRequest
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

        ];

    }
    public function messages()
    {
        return [

            'grade_id.required' => __('This field is required'),
            'classroom_id.required' => __('This field is required'),
        ];
    }




}
