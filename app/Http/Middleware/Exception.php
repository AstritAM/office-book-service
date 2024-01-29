<?php

namespace App\Http\Middleware;

use App\DTO\ResponseData;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Exception
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
        $response = $next($request);
        if ($response->exception instanceof Exception){
            return response(ResponseData::fail('An error has occurred', []), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }
}
