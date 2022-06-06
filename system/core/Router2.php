<?php

namespace System\Core;

use ArrayIterator;
use System\Helpers\ArrayHelper;

/**
 * Router v2
 */
class Route
{
    private static $_instance = null;

    private Request $request;
    private Response $response;

    protected array $routes = [];
    //will store all the parameters value in this array
    protected array $params = [];
    //will store all the parameters names in this array
    protected array $paramKey = [];

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    private static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new static;
        }
        return self::$_instance;
    }
    /**
     * Set request
     */
    public static function setRequest(Request $request)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->request = $request;
    }
    /**
     * Set response
     */
    public static function setResponse(Response $response)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->response = $response;
    }
    /**
     * Get request
     */
    public static function resource($path, $callback)
    {
        Route::get($path, [$callback, 'index']);
        Route::post($path, [$callback, 'store']);
        Route::put($path, [$callback, 'update']);
        Route::delete($path, [$callback, 'destroy']);
    }
    /**
     * Get request
     */
    public static function get($path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->_method('get', $path, $callback);
    }
    /**
     * Get request
     */
    public static function head($path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->_method('head', $path, $callback);
    }

    /**
     * Post request
     */
    public static function post($path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->_method('post', $path, $callback);
    }
    /**
     * Put request
     */
    public static function put($path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->_method('put', $path, $callback);
    }
    /**
     * patch request
     */
    public static function patch($path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->_method('patch', $path, $callback);
    }

    /**
     * Delete request
     */
    public static function delete($path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->_method('delete', $path, $callback);
    }

    /**
     * Option request
     */
    public static function options($path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->_method('options', $path, $callback);
    }

    /**
     * Method
     */
    private static function _method($method, $path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $pattern = "/{(.*?)}/";
        $replace = "/{.*}/";

        // remove first and last forward slashes
        $content =  preg_replace("/(^\/)|(\/$)/", "", $path);
        $req_url =  preg_replace("/(^\/)|(\/$)/", "", $self->request->getUrl());
        preg_match_all($pattern, $content, $matches);
        // print_r($matches[1]);

        // replace {params} with url
        $content1 = preg_replace($pattern, $req_url, $content);
        $content = implode('/', array_unique(explode('/', $content1)));

        //setting parameters names
        foreach ($matches[1] as $key) {
            // remove first and last forward slashes
            $key = preg_replace("/(^\/)|(\/$)/", "", $key);
            $self->paramKey[$content] = $key;
        }
        $self->routes[$method][$content] = $callback;
    }


    /**
     * Resolve routes
     */
    public static function resolve()
    {
        self::getInstance();
        $self = self::$_instance;

        $path =  preg_replace("/(^\/)|(\/$)/", "", $self->request->getUrl());
        $method = $self->request->getMethod();
        $callback = $self->routes[$method][$path] ?? false;

        if ($callback === false) {
            show_404();
            exit;
        }

        // If $callback is callable then call it
        if (is_callable($callback)) {
            echo call_user_func($callback,$self->request, $self->response);
        }

        // --------------------------------------------------------------

        // Specify Controller and method
        if (is_array($callback)) {
            $controller = $callback[0];
            $controllerMethod = $callback[1];

            // Check is class exist
            if (class_exists($controller)) {
                $class = new $controller();
                // Check method is exist
                if (method_exists($class, $controllerMethod)) {

                    foreach ($class->getMiddleware() as $middleware) {
                        $mw = new $middleware();
                        echo $mw->handle($self->request, function (Request $request) {
                        });
                    }

                    // call method
                    echo call_user_func(array($class, $controllerMethod), $self->request, $self->response);
                } else {
                    show_error("Method not exist: <strong>" . $controllerMethod . "</strong>");
                }
            } else {
                show_error("Controller not exist: <strong>" . $controller . "</strong>");
            }
        }
    }
}
