<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        //TO-DO: validar request...
        $userData = $request->only('email', 'password');
        $userData['password'] = bcrypt($userData['password']);
        if(!$user = $user->create($userData))
            abort(500, 'Error to create a new user...');

        return response()
            ->json([
                'data' => [
                    'user' => $user
                ]
            ]);
    }
}
