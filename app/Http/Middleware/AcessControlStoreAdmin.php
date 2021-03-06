<?php

namespace App\Http\Middleware;

use Closure;

class AcessControlStoreAdmin
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

        if (auth()->user()->role == 'ROLE_USER')

            redirect()->route('user.orders');


        return $next($request);
    }
}
