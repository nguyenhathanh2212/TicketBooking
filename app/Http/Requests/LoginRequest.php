<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        $rules = [
            'email' => 'required|email',
            'password' => 'required|digits_between:6,20',
        ];

        if (isset($this->confirm_password)) {
            $rules['confirm_password'] = 'same:password';
            $rules['email'] = 'required|email|unique:users';
        }

        return $rules;
    }
}
