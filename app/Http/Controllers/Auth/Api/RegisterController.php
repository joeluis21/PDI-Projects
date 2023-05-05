<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class RegisterController extends Controller
{
    public function register(UserPostRequest $request, User $user)
    {
        //TO-DO: validar request...
        $request->validated();
        

        $userData = $request->only('name', 'email', 'password');
        $userData['password'] = bcrypt($userData['password']);
        if (!$user = $user->create($userData))
            abort(500, 'Error to create a new user...');

        return response()
            ->json([
                'data' => [
                    'user' => $user
                ]
            ]);
    }
}
