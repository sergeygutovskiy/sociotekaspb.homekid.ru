<?php

namespace App\Http\Middleware;

use App\Http\Responses\Auth\AccessDeniedErrorResponse;
use App\Http\Responses\ErrorResponse;
use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ( $request->user()->is_admin ) return $next($request);
        return AccessDeniedErrorResponse::response();
    }
}
