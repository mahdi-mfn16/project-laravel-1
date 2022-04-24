<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if (!$request->user()->privilege) {
            alert()->error("You Don't Have Permission to Access this Page!", 'Error');
            return redirect(route('index'));
        }
        return $next($request);
        
    }
}
