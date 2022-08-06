<?php

namespace App\Exceptions;

use App\Http\Responses\Auth\NotAuthErrorResponse;
use App\Http\Responses\Resources\ResourceNotFoundErrorResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ( $request->is('api/*') ) return ResourceNotFoundErrorResponse::response();
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return NotAuthErrorResponse::response();
    }
}
