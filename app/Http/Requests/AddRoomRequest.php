<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRoomRequest extends FormRequest
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
            'name' => 'required|string',
            'capacity' => 'required|integer',
            'price' => 'required|integer',
            'room_image_1' => 'nullable|image|mimes:jpg,jpeg,png',
            'room_image_2' => 'nullable|image|mimes:jpg,jpeg,png',
            'room_image_3' => 'nullable|image|mimes:jpg,jpeg,png',
            'room_image_4' => 'nullable|image|mimes:jpg,jpeg,png',
        ];
    }
}
