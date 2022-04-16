<?php

namespace App\Http\Middleware;

use Closure;

class CheckPrivilege
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
        if ($request->user()->privilege) {
            return redirect(route('admin-index'));
        }
        return $next($request);
        
    }
}
