<?php

class Route
{
    private static $_instance = null;

    public Request $request;
    protected array $routes = [];

    private static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new static;
        }
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
     * Get request
     */
    public static function get($path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->routes['get'][$path] = $callback;
    }

    /**
     * Post request
     */
    public static function post($path, $callback)
    {
        self::getInstance();
        $self = self::$_instance;

        $self->routes['post'][$path] = $callback;
    }

    /**
     * Resolve routes
     */
    public static function resolve()
    {
        self::getInstance();
        $self = self::$_instance;

        $path = $self->request->getUrl();
        $method = $self->request->getMethod();
        $callback = $self->routes[$method][$path] ?? false;

        if ($callback === false) {
            show_404();
            exit;
        }
        // If $callback is callable then call it
        if (is_callable($callback)) {
            echo call_user_func($callback);
        }
    }
}
