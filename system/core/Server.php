<?php
/**
 * Server config class
 */
class Server
{
    public static function init(){
        
        if(file_exists("storage/down")){
            $server_meta = json_decode(file_get_contents('storage/down'), true);
        
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
