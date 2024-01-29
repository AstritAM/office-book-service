<?php

namespace App\Http\Requests;

use App\Enum\ReservationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ReservationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', new Enum(ReservationType::class)],
            'officeId' => 'required|int',
            'roomId' => 'required|int',
            'placeId' => 'int|nullable',
            'userId' => 'required|int',
            'dateFrom' => 'required|date_format:Y-m-d H:i:s',
            'dateTo' => 'required|date_format:Y-m-d H:i:s|after_or_equal:dateFrom',
        ];
    }
}
