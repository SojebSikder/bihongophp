<?php
/**
 * String Helper
 */

 if(!function_exists('randomText')){

    function randomText($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength= strlen($characters);
        $randomString = '';
        for ($i=0; $i <$length ; $i++) { 
            $randomString .=$characters[rand(0,$charactersLength-1)];
        }
        return $randomString;
    }
 }
?>