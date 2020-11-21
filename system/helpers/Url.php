<?php 
/**
 * Url Helper
 */
class Url
{
    /**
     * Redirect
     */
    public static function redirect($url ='')
    {
        $doc = "<script>function red(){ window.location='$url' }; setTimeout('red()', 0);</script>";
        echo $doc;
    }


}




