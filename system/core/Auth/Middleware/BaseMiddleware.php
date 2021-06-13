<?php

namespace System\Core\Auth\Middleware;

use Closure;
use System\Core\Request;

abstract class BaseMiddleware
{
    abstract public function handle(Request $request, Closure $next);
}
