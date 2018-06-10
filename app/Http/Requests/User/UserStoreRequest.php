<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|string|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'birthday' => 'required|date',
            'gender' => 'required|string|max:6',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
