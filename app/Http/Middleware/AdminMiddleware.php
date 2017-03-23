<?php

namespace App\Http\Middleware;

use Closure;
use App\UserPrivilege;

class AdminMiddleware
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
        if ($request->user()->userPrivilege->level != UserPrivilege::USER_PRIVILEGE_ADMIN) {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
