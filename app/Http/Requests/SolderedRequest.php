<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolderedRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Brand' => 'string',
            'Model' => 'string',
            'HC' => 'numeric|nullable',
            'VC' => 'numeric|nullable',
            'width' => 'numeric|nullable',
            'height' => 'numeric|nullable',
            'Connection' => 'string|nullable',
            'Bar' => 'string|nullable',
        ];
    }
}
