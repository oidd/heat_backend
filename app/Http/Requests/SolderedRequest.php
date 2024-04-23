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
            'Brand' => 'required',
            'Model' => 'required',
            'HC' => 'required',
            'VC' => 'required',
            'width' => 'required',
            'height' => 'required',
            'Connection' => 'required',
            'Bar' => 'required',
        ];
    }
}
