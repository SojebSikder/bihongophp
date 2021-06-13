<?php

namespace App\Middleware;

use Closure;
use System\Core\Auth\Middleware\BaseMiddleware;
use System\Core\Request;

class CheckAge extends BaseMiddleware
{
    public $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($request->get('age') < 10) {
            return "Write";
        }
        return $next($request);
    }
}
