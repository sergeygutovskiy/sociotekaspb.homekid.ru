<?php

namespace App\Http\Responses;

use Illuminate\Http\Resources\Json\JsonResource;

class OKResponse
{
    public static function response(
        array | string | JsonResource | null $data = null, 
        array | string | null $meta = null,
    ): \Illuminate\Http\JsonResponse
    {
        return Response::response(null, $data, $meta, 200);
    }
}