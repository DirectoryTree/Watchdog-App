<?php

namespace App\Http\Middleware;

use Closure;
use Webstronauts\Unpoly\Unpoly as UnpolyMiddleware;

class Unpoly extends UnpolyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $this->decorateResponse($request, $response);

        return $response;
    }
}
