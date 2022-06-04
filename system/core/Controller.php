<?php

namespace System\Core;

use System\Core\Auth\Middleware\BaseMiddleware;
use System\Core\Routing\ControllerMiddlewareOptions;

/*
* Main Controller
*/
abstract class Controller
{
    public $load = array();
    public $input = array();
    public $benchmark = array();

    public string $action = '';
    /**
     * The middleware registered on the controller.
     *
     * @var array
     */
    protected $middleware = [];

    public function __construct()
    {
        $this->load = new Load();
        $this->input = new Input();
        $this->benchmark = new Benchmark();
    }


    // for testing
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middleware[] = $middleware;
    }

    /**
     * Register middleware on the controller.
     *
     * @param  \Closure|array|string  $middleware
     * @param  array  $options
     */
    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }
        return new ControllerMiddlewareOptions($options);
    }
    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }
}
