<?php

namespace App\Middleware;

use Closure;
use System\Core\Auth\Middleware\BaseMiddleware;
use System\Core\Request;

class CheckAge extends BaseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->get('age') <= 200) {
            return "Write";
        }
        return $next($request);
    }
    // public function handle(Request $request, Closure $next)
    // {
    //     if ($request->age <= 200) {
    //         return "Write";
    //     }
    //     return $next($request);
    // }
}
