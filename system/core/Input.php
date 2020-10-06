<?php
/**
 * Input Class
 */



 class Input
 {
    public function post($url){
        session_start();

        if(!empty($_POST['token'])){
            if(hash_equals($_SESSION['token'], $_POST['token']))
            {
                if(isset($_POST[$url])){
                    return $_POST[$url];
                }
            }

            
        }
        
    }

    public function get($url){
        session_start();

        if(!empty($_GET['token'])){
            if(hash_equals($_SESSION['token'], $_GET['token']))
            {

                if(isset($_GET[$url])){
                    return $_GET[$url];
                }
            }
        }
    }

    public function request($url){
        session_start();
        
        if(!empty($_REQUEST['token'])){
            if(hash_equals($_SESSION['token'], $_REQUEST['token']))
            {

                if(isset($_REQUEST[$url])){
                    return $_REQUEST[$url];
                }
            }
        }
    }
     
 }
 

?>