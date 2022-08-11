<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\ErrorResponse;

class AccessDeniedErrorResponse
{
    public static function response(): \Illuminate\Http\JsonResponse
    {
        return ErrorResponse::response('Недостаточно прав', 403);
    }
}
