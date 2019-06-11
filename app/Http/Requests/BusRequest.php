<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusRequest extends FormRequest
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
            'lisense_plate' => 'required',
            'driver_name' => 'required',
            'number_of_seats' => isset($this->type_bus_id) && isset($this->type_bus_id) > 0 ? 'nullable|numeric' : 'required|numeric' ,
            'status' => 'required',
        ];

        if ($this->method() == 'POST') {
            $rules['company_id'] = 'required';
        }

        return $rules;
    }
}
