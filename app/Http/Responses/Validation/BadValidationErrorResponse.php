<?php

namespace App\Http\Responses\Validation;

use App\Http\Responses\ErrorResponse;

class BadValidationErrorResponse
{
    public static function response(\Illuminate\Support\MessageBag $meta): \Illuminate\Http\JsonResponse
    {
        return ErrorResponse::response('Ошибка валидации', 400, $meta);
    }
}
