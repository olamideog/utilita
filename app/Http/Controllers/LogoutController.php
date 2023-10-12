<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Log the user out of the application.
     */
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->string('email')->trim())->first();
        $user->tokens()->delete();
    }
}
