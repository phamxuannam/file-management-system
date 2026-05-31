<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditProfileRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['string', 'max:255'],
            'current_password' => ['required',
                function($attribute, $value, $fail){
                    if(!Hash::check($value, Auth::user()->password)){
                        $fail('The current password is incorrect.');
                    }
                }],
            'new_password' => [Password::min(8)->mixedCase()->numbers()->symbols()],
            'confirm_password' => ['required','same:new_password'],
        ];
    }
}
