<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'street' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string'
        ];
    }
}
