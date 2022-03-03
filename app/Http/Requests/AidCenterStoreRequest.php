<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AidCenterStoreRequest extends FormRequest
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
            'city' => ['string'],
            'region' => ['string'],
            'address' => ['required', 'string', 'max:400'],
            'phone' => ['required', 'string', 'max:100'],
            'required' => ['string'],
            'description' => ['string'],
        ];
    }
}
