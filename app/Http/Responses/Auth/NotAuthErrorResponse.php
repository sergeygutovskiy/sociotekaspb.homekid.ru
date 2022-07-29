<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\ErrorResponse;

class NotAuthErrorResponse
{
    public static function response(): \Illuminate\Http\JsonResponse
    {
        return ErrorResponse::response('Ошибка авторизации', 401);
    }
}
