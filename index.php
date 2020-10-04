<?php 
define("BASE","");
$routes = array();
$mail = array();
/**
 * Setup Files
 */
include "config/config.php";
include "config/routes.php";
include "config/email.php";
/**
 * Core Files
 */
include BASE.$system_path."/core/Controller.php";
include BASE.$system_path."/core/Model.php";
include BASE.$system_path."/core/Load.php";
include BASE.$system_path."/core/Input.php";
include BASE.$system_path."/core/Benchmark.php";

/**
 * Database Files
 */
include BASE.$system_path."/database/drivers/MySQLAdapter.php";
include BASE.$system_path."/database/Dbase.php";
//include BASE.$system_path."/core/Database.php";
//include_once BASE.$system_path."/core/Route.php";


/**
 * Exceptions
 */
/*
*error reporting
*/
define('ENVIRONMENT', $config['mode']);

switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);

		ini_set("error_reporting", "true");
		error_reporting(E_ALL | E_STRCT);
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>=')){
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}




//Core
$url = isset($_GET['url']) ? $_GET['url'] : NULL;
if($url != NULL){
    $url = rtrim($url, '/');
    $url = explode("/", filter_var($url, FILTER_SANITIZE_URL));
}else{
    unset($url);
}

foreach ($route as $key => $value) {
    $break = explode("/", filter_var($value, FILTER_SANITIZE_URL));

    
    if(!isset($url[0])){
        if($route['default_controller'] != null){

            include BASE.$application_folder."\/controllers/".$break[0]."Controller.php";
            $class = $break[0]."Controller";
            $ur = new $class();
            if(isset($break[1])){
                $method = $break[1];
            }else{
                $method = "home";
            }
            
            $ur->$method();
        break;
        }
    }
    else

    if($url[0] == $key)
    {

        /**
         * Form Routes File
         */
        //$class = $break[0];
        //$method = $break[1];
        //$perameter = $break[2];


        /**
         * $url[0] = controller
         * $url[1] = method
         * $url[2] = perameter
         */
        if(isset($break[0]))
        {

            include BASE.$application_folder."/"."controllers/".$break[0]."Controller.php";
            $s = $break[0]."Controller";
            $ur = new $s();
            if(isset($break[2])){
                $method = $break[1];
                $ur->$method($break[2]); 
            }else{
                if(isset($break[1])){
                    $method = $break[1];
                    $ur->$method();
                }else{
                    $ur->home();
                }
            }
    

        }else
        {
            include BASE.$application_folder."\/controllers/".$break[0]."Controller.php";
            $class = $break[0]."Controller";
            $ur = new $class();
            if(isset($break[1])){
                $method = $break[1];
            }else{
                $method = "home";
            }
            $ur->$method();
        break;
        }
        //end core
    

    }
    
}

?>