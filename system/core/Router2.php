<?php

namespace System\Core;

use App\Controllers;

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
        global $application_folder;

        self::getInstance();
        $self = self::$_instance;

        $controller_url = $application_folder . "\/controllers/";
        $default_method = "home";

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



        if (is_array($callback)) {
            $controller = $callback[0];
            $controllerMethod = $callback[1];


            //require $controller_url . $controller . ".php";

            try {
                //code...



                //$class = new $controller();

                echo "test";

                $class = IndexController::class;

                echo $class;

                $c = new $class(); //new \App\Controllers\IndexController();
                echo $c->index();

                //echo call_user_func(array($class, $controllerMethod));

            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}
