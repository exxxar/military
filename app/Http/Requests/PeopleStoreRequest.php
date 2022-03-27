<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleStoreRequest extends FormRequest
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
            'uuid' => ['required'],
            'fname' => ['string'],
            'sname' => ['string'],
            'tname' => ['string'],
            'birth' => ['string'],
            'age_from' => ['string'],
            'age_to' => ['string'],
            'sex' => ['required', 'string'],
            'photos' => ['json'],
            'phone' => ['string'],
            'user_id' => ['integer', 'exists:users,id'],
            'people_id' => ['integer', 'exists:people,id'],
            'city' => ['string'],
            'region' => ['string'],
            'address' => ['string'],
            'story' => ['string'],
            'description' => ['string'],
            'status' => ['required', 'integer'],
            'for' => ['required', 'integer'],
            'searched_from' => [''],
            'is_active' => ['required'],
            'deleted_at' => [''],
            'created_at' => ['required'],
            'updated_at' => ['required'],
        ];
    }
}
