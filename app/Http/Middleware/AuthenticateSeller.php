<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateSeller
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

        if(auth()->user()->seller()->exists()){

            return $next($request);
        }else{
            return redirect('/home')->with(['reponse' => 'error', 'message' => 'Unauthorized access!']);
        }
    }
}
