<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrseriesRequest extends FormRequest
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
            'b' => 'numeric|nullable',
            'c' => 'numeric|nullable',
            'd' => 'numeric|nullable',
            'e' => 'numeric|nullable',
            'f' => 'string|nullable',
            'g' => 'string|nullable',
            'pipes_count' => 'numeric|nullable',
            'pipe_area' => 'numeric|nullable',
            'volume' => 'numeric|nullable',
            'pump_flow' => 'numeric|nullable',
            'water_consumption' => 'numeric|nullable',
            'Notes' => 'string|nullable',
        ];
    }
}
