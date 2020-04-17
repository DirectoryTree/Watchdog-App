<?php

namespace App\Http\Middleware;

use Closure;

class ForceHttps
{
    /**
     * Force HTTPS if the app is running in production.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            !app()->isLocal()
            && !app()->runningUnitTests()
            && !$request->isSecure()
        ) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
