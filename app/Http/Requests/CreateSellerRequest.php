<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSellerRequest extends FormRequest
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
            "owner_id" => "required|exists:users,id",
            "name" => "required|string",
            "lat" => "required|numeric",
            "long" => "required|numeric",
            "service_radius" => "required|integer",
            "address" => "required|string",
        ];
    }
}
