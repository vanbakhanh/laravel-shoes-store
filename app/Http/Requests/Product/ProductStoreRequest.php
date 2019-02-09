<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|unique:products|max:255',
            'description' => 'required',
            'gender' => 'required|boolean',
            'price' => 'required',
            'image' => 'required|max:5',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'color' => 'required',
            'size' => 'required',
        ];
    }
}
