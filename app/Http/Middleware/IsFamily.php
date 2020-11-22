<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use Redirect;

class IsFamily
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
        if ( Auth::check() && (Auth::user()->isFamily()!=0))
        {
            return $next($request);
        }
        Session::flash('warning', "Vous ne pouvez pas accéder à cette page");
        return Redirect::back();
    }
}
