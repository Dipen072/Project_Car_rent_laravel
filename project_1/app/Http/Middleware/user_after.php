<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class user_after
{
    public function handle(Request $request, Closure $next): Response
    {
        if(session('user_id'))
        {
            return $next($request);
        }
        else
        {
            return redirect('/login');
        }
    }
}