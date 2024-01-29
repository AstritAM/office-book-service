<?php

namespace App\Http\Middleware;

use App\DTO\ResponseData;
use App\Exceptions\NotFoundException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CatchNotFoundException
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|object
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if ($response->exception instanceof NotFoundException) {
            return response(ResponseData::fail($response->exception->getMessage(), []), ResponseAlias::HTTP_NOT_FOUND);
        }
        return $response;
    }
}
