<?php

namespace App\Http\Middleware;

use function auth;
use Closure;
use function dd;
use function session;

class SellerCapabilityMiddleware
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
       if(auth()->user()->user_type_id == '2'){
           return $next($request);
       }
           /*    if( session('account_type') == 'buyer'){
                  if(auth()->user()->has('buyer')->count()){
                      return redirect( route('buyer.profile' , ['id' => auth()->user()->buyer()->id]) );
                  }else{
                      return redirect( route('buyer.profile' , ['id' => auth()->user()->buyer()->id]) );
                  }
              }else{
                  return $next($request);
              }
          }else{
              return redirect( route('admin.index') );
          }*/


    }
}
