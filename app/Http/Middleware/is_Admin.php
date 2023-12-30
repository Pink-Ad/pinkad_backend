<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class is_Admin
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
        if(auth()->check())
        {
            if(auth()->user()->role == 1)
            {
                // dd(auth()->user());
                return $next($request);
            }
            else
            {
                Auth::logout();
                return redirect()->route('login')->withErrors("Invalid Credentials...");
            }
        }
        else
        {
            return redirect()->route('login');

        }
    }
}
