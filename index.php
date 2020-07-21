<?php 
define("BASE","");
include BASE."system/libs/Controller.php";
include BASE."system/libs/Model.php";
include BASE."system/libs/Load.php";

include_once BASE."system/libs/Database.php";

$url =isset($_GET['url']) ? $_GET['url'] : NULL;
if($url != NULL){
    $url = rtrim($url,'/');
    $url = explode("/",filter_var($url,FILTER_SANITIZE_URL));
}else{
    unset($url);
}

if(isset($url[0])){
    include BASE."app/controllers/".$url[0]."Controller.php";
    $s = $url[0]."Controller";
    $ur = new $s();
    if(isset($url[2])){
        $method = $url[1];
        $ur->$method($url[2]);
    }else{
        if(isset($url[1])){
            $method = $url[1];
            $ur->$method();
        }else{
            $ur->home();
        }
    }
}else{
    include BASE."app/controllers/IndexController.php";
    $ur = new IndexController();
    $ur->home();
}


?>