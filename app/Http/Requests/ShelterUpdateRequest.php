<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShelterUpdateRequest extends FormRequest
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
            'city' => ['required', 'string'],
            'region' => ['required', 'string'],
            'address' => ['required', 'string', 'max:400'],
            'lat' => ['required', 'numeric'],
            'lon' => ['required', 'numeric'],
            'balance_holder' => ['required', 'string'],
            'responsible_person' => ['required', 'string'],
            'capacity' => ['required', 'integer'],
            'description' => ['required', 'string'],
        ];
    }
}
