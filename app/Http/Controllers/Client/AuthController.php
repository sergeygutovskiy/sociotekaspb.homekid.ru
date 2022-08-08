<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\Auth\UserNotFoundErrorResponse;
use App\Http\Responses\OKResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function check(Request $request)
    {
        $user = $request->user();

        return OKResponse::response([
            'id' => $user->id,
            'login' => $user->login,
            'is_admin' => $user->is_admin,
        ]);
    }

    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        if ( !Auth::attempt([ 'login' => $login, 'password' => $password ]) )
        {
            return UserNotFoundErrorResponse::response();
        }
            
        $user = User::firstWhere('login', $login);
        if ( !$user ) return UserNotFoundErrorResponse::response();
        
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return OKResponse::response([
            'user' => [
                'id' => $user->id,
                'login' => $user->login,
                'is_admin' => $user->is_admin,
            ],
            'token' => [
                'value' => $token,
                'type' => 'Bearer',
            ],
        ]);
    }
}
