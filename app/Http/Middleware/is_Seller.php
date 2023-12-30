<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class is_Seller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('api')->user())
        {
            if(auth('api')->user()->role == 2)
            {
                // dd(auth('api')->user());
                return $next($request);
            }
            else
            {
                Auth::logout();
                return response()->json(['error'=> 'unauthorized'],401);
            }
        }
        else
        {
            return response()->json(['error'=> 'unauthorized'],401);

        }
    }
}
