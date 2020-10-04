<?php
/**
 * Input Class
 */

 class Input
 {
    public function post($url){
        if(isset($_POST[$url])){
            return $_POST[$url];
        }
    }

    public function get($url){
        if(isset($_GET[$url])){
            return $_GET[$url];
        }
    }

    public function request($url){
        if(isset($_REQUEST[$url])){
            return $_REQUEST[$url];
        }
    }
     
 }
 

?>