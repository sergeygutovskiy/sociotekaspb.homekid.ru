<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Войти в аккаунт
     * 
     * @group Юзеры
     * 
     * @bodyParam login string required Логин Example: user1
     * @bodyParam password string required Пароль Example: 1234
     * 
     */
    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        if ( !Auth::attempt([ 'login' => $login, 'password' => $password ]) )
        {
            return response()->json([
                'error' => 'Пользователь не найден',
                'data' => null,
            ], 401);
        }
            
        $user = User::firstWhere('login', $login);
        if ( !$user )
        {
            return response()->json([
                'error' => 'Пользователь не найден',
                'data' => null,
            ], 401); 
        }
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'error' => null,
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],
        ]);
    }
}
