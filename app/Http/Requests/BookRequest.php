<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BookRequest extends FormRequest
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
            'title' => 'required|max:100',

        ];

    }

    public function messages()
    {
        return [

            'grade_id.required' => __('This field is required'),
            'classroom_id.required' => __('This field is required'),
            'section_id.required' => __('This field is required'),
            'title.required' => __('This field is required'),
            'title.max' => __('This is field must be no more than 100 characters'),




        ];
    }




}
