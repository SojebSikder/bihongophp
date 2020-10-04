<?php
//include "../../config/config.php";
/**
 * Route Class
 */
class Route
{
    public $url = "http://localhost/bihongophp/";
    public $routes = array();

    public $class = '';

    public $method = '';

    public function set_route(){
        if (file_exists('../../config/routes.php'))
		{
            include('../../config/routes.php');
            echo $route['default_controller'];
            header("Location:".$this->url.$route['default_controller']);
		}else{
            echo "not found";
        }
    }

}

$rt = new Route();
$rt->set_route();



?>