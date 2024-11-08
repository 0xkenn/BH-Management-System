<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ensure that this request is authorized
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|string|in:male,female,other',
            'mobile_number' => 'nullable|string|max:20',
            'is_student' => 'nullable|boolean',
            'region_code' => 'nullable|string',
            'province_code' => 'nullable|string',
            'city_municipality_code' => 'nullable|string',
            'current_password' => [
                'required', 
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('The provided current password is incorrect.');
                    }
                },
            ],
            'new_password' => 'nullable|string|min:8|confirmed', // Ensures new password confirmation (requires `new_password_confirmation` field)
        ];
    }
}
