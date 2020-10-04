<?php
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