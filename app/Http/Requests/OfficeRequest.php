<?php

namespace App\Http\Requests;

use App\Rules\ArrayCoordinatesRule;
use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'location' => 'string',
            'scheme' => ['required', new ArrayCoordinatesRule()]
        ];
    }
}
