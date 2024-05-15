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
            'password'=> 'required|min:8|confirmed',
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
                'password'=> 'nullable|min:8|confirmed',
                'phone'=> 'required',
                'specialization_id'=> 'required',
                'joining_date'=> 'required',
                'address'=> 'required',
                'note'=> 'nullable',
            ];
        }
        return $rules;
    }
}
