<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
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
            'company_id' => 'required',
            'start_station_id' => 'required',
            'destination_station_id' => 'required',
            'start_time' => 'required',
            'destination_time' => 'required',
            'phone' => 'numeric',
            'number_preset_date' => 'required|numeric',
            'status' => 'required',
        ];
    }
}
