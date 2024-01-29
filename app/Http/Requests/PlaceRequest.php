<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'scheme.x' => 'required|int',
            'scheme.y' => 'required|int',
            'scheme.width' => 'required|int',
            'scheme.height' => 'required|int',
        ];
    }
}
