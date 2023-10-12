<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)],
        ];
    }
}
