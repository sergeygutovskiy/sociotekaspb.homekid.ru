<?php

namespace App\Http\Responses\Resources;

use App\Http\Responses\OKResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceOKResponse
{
    public static function response(JsonResource $data): \Illuminate\Http\JsonResponse
    {
        return OKResponse::response($data);
    }
}