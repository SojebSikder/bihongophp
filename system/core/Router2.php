<?php

namespace System\Core;


class Route
{
    private static $_instance = null;

    private Request $request;
    private Response $response;

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
        global $application_folder;

        self::getInstance();
        $self = self::$_instance;

        // $controller_url = $application_folder . "\/controllers/";
        // $default_method = "home";

        $path = $self->request->getUrl();
        $method = $self->request->getMethod();
        $callback = $self->routes[$method][$path] ?? false;

        if ($callback === false) {
            show_404();
            exit;
        }
        // If $callback is callable then call it
        if (is_callable($callback)) {
            echo call_user_func($callback, $self->request, $self->response);
        }

        // Specify Controller and method
        if (is_array($callback)) {
            $controller = $callback[0];
            $controllerMethod = $callback[1];

            // Check is class exist
            if (class_exists($controller)) {
                $class = new $controller();
                // Check method is exist
                if (method_exists($class, $controllerMethod)) {
                    // call method
                    echo call_user_func(array($class, $controllerMethod));
                } else {
                    show_error("Method not exist: <strong>" . $controllerMethod . "</strong>");
                }
            } else {
                show_error("Controller not exist: <strong>" . $controller . "</strong>");
            }
        }
    }
}
