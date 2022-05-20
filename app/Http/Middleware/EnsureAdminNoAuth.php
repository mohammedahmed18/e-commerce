<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdminNoAuth{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('admin')->user()) {
            return $next($request);
        }
 
       return redirect('/dashboard');
    }

}