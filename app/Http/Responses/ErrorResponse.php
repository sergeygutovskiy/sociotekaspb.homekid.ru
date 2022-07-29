<?php

namespace App\Http\Responses;

class ErrorResponse
{
    public static function response(
        array | string $error, 
        int $status_code,
        array | string | null $meta = null,
    ): \Illuminate\Http\JsonResponse
    {
        return Response::response($error, null, $meta, $status_code);
    }
}