<?php
/**
 * Server config class
 */
class Server
{
    public static function init(){
        global $server_meta;
        
        if(file_exists("storage/down.php")){
            require "storage/down.php";
        
            header("HTTP/1.1 503 Service Temporarily Unavailable");
            header("Status: 503 Service Temporarily Unavailable");
        
            if($server_meta['retry'] != null){
                header('Retry-After: '.$server_meta['retry']);
            }
            if($server_meta['message'] != null){
                echo $server_meta['message'];
            }else{
                echo '<title>Service Unavailable</title>
            <h3>Service Unavailable</h3>';
            }
            
        }else{
            //Initialize Router
            Router::init();
        }
    }
}
