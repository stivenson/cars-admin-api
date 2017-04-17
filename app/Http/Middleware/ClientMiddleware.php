<?php

namespace senseibistro\Http\Middleware;

use Closure;

class ClientMiddleware
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
        if( \Auth::user() != null && \Auth::user()->type == "Client" ){
            return $next($request);
        }

        return redirect('/login_user');
    }
}
