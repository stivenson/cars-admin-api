<?php

namespace senseibistro\Http\Middleware;

use Closure;
use Auth;
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
        if( Auth::user() != null && Auth::user()->roles_id == 1 ){
            return $next($request);
        }

        return redirect('/login');
    }
}
