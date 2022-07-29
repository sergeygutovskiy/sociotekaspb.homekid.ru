<?php 

namespace App\Http\Responses;

use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class Response 
{
    public static function response(
        array | string | null $error, 
        array | string | JsonResource | null $data, 
        array | string | null $meta,
        int $status_code,
    ): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => $error,
            'data' => $data,
            'meta' => $meta,
        ], $status_code);
    }
}
