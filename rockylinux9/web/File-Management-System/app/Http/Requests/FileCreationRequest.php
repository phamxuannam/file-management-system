<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FileCreationRequest extends FormRequest
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
            'file' => [ 'required', 'file', 'mimes:xlsx,xls,xlsm,csv,xltx', 'max:10240' ],
            'description' => [ 'max:1000', 'nullable' ],
            'user_id' => [ 'required', 'exists:users,id' ],
            'visibility' => [ 'required', Rule::in([1, 2, 3]) ]
        ];
    }
}
