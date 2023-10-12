<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:55'],
            'last_name' => ['required', 'string', 'max:55'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'address' => ['required', 'string', 'max:55'],
            'city' => ['required', 'string', 'max:55'],
            'postcode' => ['required', 'string', 'max:9'],
        ];
    }
}
