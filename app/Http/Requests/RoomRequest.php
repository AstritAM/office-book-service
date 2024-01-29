<?php

namespace App\Http\Requests;

use App\Enum\RoomType;
use App\Rules\ArrayCoordinatesRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class RoomRequest extends FormRequest
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
            'type' => [new Enum(RoomType::class)],
            'scheme' => ['required', new ArrayCoordinatesRule()]
        ];
    }
}
