<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SectionRequest extends FormRequest
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
            'name_ar' => 'required|max:50',
            'name_en' => 'required|max:50',
            'admin_id' => 'required',
            'grade_id' => 'required',
            'classroom_id' => 'required',
        ];

    }
}
