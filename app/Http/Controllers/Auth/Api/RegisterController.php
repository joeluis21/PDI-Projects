<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        //TO-DO: validar request...
        $validate =  $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
        ]);


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
