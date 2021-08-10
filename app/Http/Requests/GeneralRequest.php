<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
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
            'company_name' => 'required',
            'company_email' => 'nullable',
            'company_phone' => 'required',
            'company_address' => 'required',
            'company_logo' => 'nullable|mimes:jpeg,png,jpg,svg|max:4096',
        ];

    }

    public function messages()
    {
        return [
            'company_name.required' => 'Please enter company name.',
            'company_logo.mimes' => 'Invalid image format. Please upload jpg,png,jpeg,svg file',
            'company_logo.max' => 'Logo must be only upto 4MB',
            'company_phone.required' => 'Company phone is required',
            'company_address.required' => 'Company address is required',
        ];
    }
}
