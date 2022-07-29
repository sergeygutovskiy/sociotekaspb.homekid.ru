<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\ErrorResponse;

class UserNotFoundErrorResponse
{
    public static function response(): \Illuminate\Http\JsonResponse
    {
        return ErrorResponse::response('Пользователь не найден', 404);
    }
}