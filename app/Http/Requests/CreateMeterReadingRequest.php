<?php

namespace App\Http\Requests;

use DateTimeInterface;

class CreateMeterReadingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'reading' => ['required', 'decimal:2'],
            'read_at' => ['required', 'date_format:'.DateTimeInterface::RFC3339],
        ];
    }
}
