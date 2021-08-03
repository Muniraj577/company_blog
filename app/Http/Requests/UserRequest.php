<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:10|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@&$#%(){}^*+-]).*$/',
                'phone' => 'nullable|min:10',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        } elseif (request()->isMethod('put') || request()->isMethod('patch')) {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->id,
                'password' => 'nullable|confirmed|min:10|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@&$#%(){}^*+-]).*$/',
                'phone' => 'nullable|min:10',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter valid email address.',
            'email.unique' => 'Email has already been taken.',
            'password.required' => 'Password field is required',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be of at least 10 characters.',
            'password.regex' => 'Password must contain at least one uppercase , lowercase, digit and special character',
            'address.required' => 'Address is required',
            'phone.min' => 'Phone must have at least 10 digits',
        ];
    }
}
