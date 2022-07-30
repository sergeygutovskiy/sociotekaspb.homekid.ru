<?php

namespace App\Http\Responses;

class ErrorResponse
{
    public static function response(
        $error, 
        $status_code,
        $meta = null,
    ): \Illuminate\Http\JsonResponse
    {
        return Response::response($error, null, $meta, $status_code);
    }
}