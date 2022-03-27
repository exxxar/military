<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HumanitarianAidHistoryStoreRequest extends FormRequest
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
            'index' => ['string'],
            'full_name' => ['string'],
            'passport' => ['string'],
            'description' => ['string'],
            'issue_at' => [''],
            'deleted_at' => [''],
            'created_at' => ['required'],
            'updated_at' => ['required'],
        ];
    }
}
