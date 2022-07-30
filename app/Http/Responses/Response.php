<?php 

namespace App\Http\Responses;

class Response 
{
    public static function response($error, $data, $meta, $status_code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => $error,
            'data' => $data,
            'meta' => $meta,
        ], $status_code);
    }
}
