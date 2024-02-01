<?php

// App\Http\Middleware\IsSalesman.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSalesman
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role == 4) {
            return $next($request);
        }
        else
        {
            Auth::logout();
            return redirect()->route('login')->withErrors("You do not have permission to access this page.");
        }

     
    }
}
