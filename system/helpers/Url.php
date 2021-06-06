<?php

/**
 * Url Helper
 */
class Url
{
    /**
     * Get asset directory
     */
    public static function asset($url)
    {
        return ASSET."$url";
    }
    /**
     * get resource directory
     */
    public static function resource($url)
    {
        return RESOURCE."$url";
    }
    /**
     * Redirect
     */
    public static function redirect($url = '')
    {
        $doc = "<script>function red(){ window.location='$url' }; setTimeout('red()', 0);</script>";
        echo $doc;
    }
}
