<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function check(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'error' => null,
            'data' => [
                'id' => $user->id,
                'login' => $user->login,
                'is_admin' => false,
            ],
        ]);
    }

    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        if ( !Auth::attempt([ 'login' => $login, 'password' => $password ]) )
        {
            return response()->json([
                'error' => 'Пользователь не найден',
                'data' => null,
            ], 404);
        }
            
        $user = User::firstWhere('login', $login);
        if ( !$user )
        {
            return response()->json([
                'error' => 'Пользователь не найден',
                'data' => null,
            ], 404); 
        }
        
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'error' => null,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'login' => $user->login,
                    'is_admin' => false,
                ],
                'token' => [
                    'value' => $token,
                    'type' => 'Bearer',
                ]
            ],
        ]);
    }
}
