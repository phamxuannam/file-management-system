<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FileUpdateRequest extends FormRequest
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
           'file' => [ 'nullable', 'file', 'max:10240', 'mimes:xlsx,xls,xlsm,csv,xltx',
                        'mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                        application/vnd.ms-excel,application/vnd.ms-excel.sheet.macroEnabled.12,
                        application/vnd.openxmlformats-officedocument.spreadsheetml.template,text/csv,text/plain'
                    ],
            'description' => [ 'nullable', 'max:1000' ],
            'visibility' => [ 'nullable', Rule::in([1, 2, 3]) ]
        ];
    }
}
