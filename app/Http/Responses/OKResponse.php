<?php

namespace App\Http\Responses;

class OKResponse
{
    public static function response($data = null, $meta = null): \Illuminate\Http\JsonResponse
    {
        return Response::response(null, $data, $meta, 200);
    }
}