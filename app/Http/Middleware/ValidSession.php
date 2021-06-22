<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class ValidSession
 * Middleware to check if the session is valid before accessing web pages
 * @package App\Http\Middleware
 */
class ValidSession
{
    /**
     * Handle an incoming request.
     * The user must have a valid session
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if(!$request->session()->has('user'))
        {
            return redirect('/login');
        }
        return $next($request);
    }
}
