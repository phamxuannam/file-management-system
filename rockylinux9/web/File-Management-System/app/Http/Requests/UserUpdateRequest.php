<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'between: 8, 255', 'string'],
            // 'email'=> ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'area_id' => ['required', 'exists: areas,id']
        ];
    }
}
