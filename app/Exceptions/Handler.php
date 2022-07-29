<?php

namespace App\Exceptions;

use App\Http\Responses\Auth\NotAuthErrorResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
        $this->reportable(function (Throwable $e) {
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return NotAuthErrorResponse::response();
    }
}
