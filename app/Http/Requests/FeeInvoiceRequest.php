<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeInvoiceRequest extends FormRequest
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
            'list_feesInvoices.*.fee_id' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'list_feesInvoices.*.fee_id.required' => __('This field is required'),
        ];
    }
}
