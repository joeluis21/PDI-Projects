<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //TO-DO: validar request...
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials))
            abort(401, 'Invalid Credentials');

        $token = auth()->user()->createToken('auth_token');

        return response()
            ->json([
                'data' => [
                    'token' => $token->plainTextToken
                ]
            ]);
    }

    public function logout()
    {
        //auth()->user()->tokens()->delete();//remove todos os tokens do usuário
        auth()->user()->currentAccessToken()->delete(); // remove apenas o token da requisição atual

        return response()
            ->json([], 204);
    }
}
