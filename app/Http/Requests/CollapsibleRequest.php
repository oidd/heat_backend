<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollapsibleRequest extends FormRequest
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
            'HC' => 'numeric',
            'VC' => 'numeric',
            'width' => 'numeric',
            'height' => 'numeric',
            'DU' => 'string',
            'file' => 'file'
        ];
    }
}
