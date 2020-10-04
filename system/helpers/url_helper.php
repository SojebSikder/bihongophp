<?php 

if(! function_exists('redirect')){
    /**
     * Redirect
     */
    function redirect($url ='')
    {
        $doc = "<script>function red(){ window.location='$url' }; setTimeout('red()', 0);</script>";
        echo $doc;
    }
}



?>