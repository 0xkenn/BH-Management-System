<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBoardingHouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'business_permit_image' => 'required|image|mimes:png,jpg,jpeg',
            'background_image' => 'required|image|mimes:png,jpg,jpeg,gif',
            'preferences' => "nullable|array",
        ];
    }
}
