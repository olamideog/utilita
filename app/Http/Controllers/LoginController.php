<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\TokenResource;
use App\Models\EmptyModel;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function __invoke(LoginRequest $request): JsonResource
    {
        $user = User::where('email', $request->string('email')->trim())->first();
        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return new EmptyResource(new EmptyModel('Credentials Are Incorrect', 'CREDENTIALS_NOT_FOUND'));
        }
        $tokenName = Str::random(8);
        $token = $user->createToken($tokenName, ['*'], now()->addDays(10));

        return new TokenResource($token);
    }
}
