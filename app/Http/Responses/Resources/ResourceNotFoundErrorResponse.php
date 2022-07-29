<?php

namespace App\Http\Responses\Resources;

use App\Http\Responses\ErrorResponse;

class ResourceNotFoundErrorResponse
{
    public static function response(): \Illuminate\Http\JsonResponse
    {
        return ErrorResponse::response('Запись не найдена', 404);
    }
}
