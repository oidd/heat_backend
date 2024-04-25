<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DtseriesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'model' => 'string',
            'a' => 'numeric|nullable',
            'c' => 'numeric|nullable',
            'd' => 'numeric|nullable',
            'e' => 'numeric|nullable',
            'g' => 'numeric|nullable',
            'h' => 'numeric|nullable',
            'j' => 'numeric|nullable',
            'k' => 'numeric|nullable',
            'l' => 'numeric|nullable',
            'm' => 'numeric|nullable',
            'n' => 'string|nullable',
            'p' => 'numeric|nullable',
            'q' => 'numeric|nullable',
            'r' => 'numeric|nullable',
            's' => 'string|nullable',
            't' => 'string|nullable',
            'max_flow' => 'numeric|nullable',
            'brass_area' => 'numeric|nullable',
            'Notes' => 'string|nullable',
        ];
    }
}
