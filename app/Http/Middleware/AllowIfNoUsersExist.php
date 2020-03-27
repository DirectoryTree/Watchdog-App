<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AllowIfNoUsersExist
{
    /**
     * Detect if users already exist in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (User::exists()) {
            return redirect('/');
        }

        return $next($request);
    }
}
