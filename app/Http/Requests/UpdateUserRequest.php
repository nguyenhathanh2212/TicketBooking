<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Hash;

class UpdateUserRequest extends FormRequest
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
        if (isset($this->is_change_password) && $this->is_change_password) {
            $rules = [
                'old_password' => 'required|between:6,20',
                'password' => 'required|between:6,20',
                'confirm_password' => 'required|between:6,20|same:password',
            ];
        } else {
            $rules = [];
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        if (isset($this->is_change_password) && $this->is_change_password) {
            $validator->after(function ($validator) {
                if (!Hash::check($this->old_password, $this->user()->password) ) {
                    $validator->errors()->add('old_password', trans('message.password_in_correct'));
                }
            });
        }

        return;
    }
}
