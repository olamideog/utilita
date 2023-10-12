<?php

namespace App\Http\Requests;

class CreateMeterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'number' => ['required', 'string', 'max:55'],
        ];
    }
}
