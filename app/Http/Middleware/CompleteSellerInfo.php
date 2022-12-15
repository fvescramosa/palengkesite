<?php

namespace App\Http\Middleware;

use Closure;

class CompleteSellerInfo
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
        if (!auth()->user()->seller()->exists()) {
            return redirect(route('seller.create'));
        }

        return $next($request);
    }
}
