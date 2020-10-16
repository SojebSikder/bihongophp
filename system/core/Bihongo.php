<?php
/**
 * Load Framework
 */
$routes = array();
$mail = array();
/**
 * Setup Files
 */
//include "config/config.php";
include "config/routes.php";
include "config/email.php";
/**
 * Core Files
 */
include $system_path."/core/Controller.php";
include $system_path."/core/Model.php";
include $system_path."/core/Load.php";
include $system_path."/core/Input.php";
include $system_path."/core/Benchmark.php";

/**
 * Database Files
 */
//include $system_path."/database/drivers/MySQLAdapter.php";
include $system_path."/database/Dbase.php";
include $system_path."/core/Database.php";
//include_once BASE.$system_path."/core/Route.php";

/**
 * Migration Files
 */
include $system_path."/core/Database/Builder.php";
include $system_path."/core/Database/Migration.php";
include $system_path."/core/Database/Schema.php";


/**
 * BihongoPHP Version
 */
const B_VERSION = '1.0.2';

//Core
$url = isset($_GET['url']) ? $_GET['url'] : NULL;
if($url != NULL){
    $url = rtrim($url, '/');
    $url = explode("/", filter_var($url, FILTER_SANITIZE_URL));
}else{
    unset($url);
}

foreach ($route as $key => $value) {
    $breakKey = explode("/", filter_var($key, FILTER_SANITIZE_URL));
    $break = explode("/", filter_var($value, FILTER_SANITIZE_URL));

    
    if(!isset($url[0])){
        if($route['default_controller'] != null){

            include $application_folder."\/controllers/".$break[0].".php"; //Controller
            $class = ucfirst($break[0]); //Controller
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

            include $application_folder."/"."controllers/".$break[0].".php"; //Controller
            $s = ucfirst($break[0]); //Controller
            $ur = new $s();
            if(isset($break[2])){
                $method = $break[1];
                $ur->$method($break[2]); 
            }else{
                if(isset($break[1])){
                    $method = $break[1];
                    
                    /**
                     * New addition for peramiter
                     */
                    if((isset($url[1])) && (!isset($url[2])))
                    {
                        $ur->$method($url[1]);

                    }else if(isset($url[2]) && (!isset($url[3]))){
                        $ur->$method($url[1], $url[2]);

                    }else if(isset($url[3]) && (!isset($url[4])) ){
                        $ur->$method($url[1], $url[2], $url[3]);

                    }else if(isset($url[4]) && (!isset($url[5]))){
                        $ur->$method($url[1], $url[2], $url[3], $url[4]);
                    }
                    else{
                        $ur->$method();
                    }
                    //end that  
                    
                }else{
                    $ur->home();
                }
            }
    
        }else
        {
            include $application_folder."\/controllers/".$break[0].".php"; //Controller
            $class = ucfirst($break[0]); //Controller
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