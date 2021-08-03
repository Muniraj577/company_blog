<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if(request()->isMethod('post')){
            return [
                "title" => "required|string",
                "url" => "nullable|url",
                "description" => "required",
                "logo" => "required|image|mimes:jpeg,jpg,png,svg|max:2048",
            ];
        } elseif(request()->isMethod('put') || request()->isMethod('patch')){
            return [
                "title" => "required|string",
                "url" => "nullable|url",
                "description" => "required",
                "logo" => "nullable|image|mimes:jpeg,jpg,png,svg|max:2048",
            ];
        }
    }
}
