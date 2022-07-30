<?php

namespace App\Http\Responses\Resources;

use App\Http\Responses\OKResponse;

class ResourceOKResponse
{
    public static function response($data): \Illuminate\Http\JsonResponse
    {
        return OKResponse::response($data);
    }
}