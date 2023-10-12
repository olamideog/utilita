<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle user registration.
     */
    public function __invoke(RegisterRequest $request): JsonResource
    {
        $user = new User();
        $user['first_name'] = $request->string('first_name')->trim();
        $user['last_name'] = $request->string('last_name')->trim();
        $user['email'] = $request->string('email')->trim();
        $user['password'] = Hash::make($request->string('password')->trim());
        $user['address'] = $request->string('address')->trim();
        $user['city'] = $request->string('city')->trim();
        $user['postcode'] = $request->string('postcode')->trim();
        $user->save();

        return new UserResource($user);
    }
}
