<?php 
class Route{
    public $name;
    public $pattern;
    public $class;
    public $params;
}

class Router{
    public $routes;

    public function __construct(array $routes){
        $this->routes = $routes;
    }

    public function resolve($app_path){
        $mathched = false;
        foreach ($this->routes as $route) {
            if(strpos($app_path, $route->pattern) == 0){
                $mathched = true;
            break;
            }
        }
        if(! $mathched) throw new Exception("Clould not match route.");

        $param_str = str_replace($route->pattern, '', $app_path);
        $params = explode('/', trim($param_str,'/'));
        $params = array_filter($params);

        $match = clone($route);
        $match->params = $params;

        return $match;
    }
}

class Controller{
    public function action(){
        var_dump(func_get_args());
    }
}

$route = new Route();
$route->name = "blog-posts";
$route->pattern ="/blog/posts";
$route->class = "Controller";
$route->method = "action";

$router = new Router(array($route));
$match = $router->resolve("/blog/posts/foo/bar");

//dispatch
if($match){
    call_user_func_array(array(new $match->class, $match->method), $match->params);
    
}



?>