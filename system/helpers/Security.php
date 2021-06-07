<?php

/**
 * Security Helper
 */
class Security
{

    public static function Stext($string, $allow = null)
    {
        if ($allow == null) {
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $text = $conn->real_escape_string(htmlspecialchars(strip_tags($string)));
        } else {
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $text = $conn->real_escape_string(strip_tags($string, $allow));
        }
        return $text;
    }


    /**
     * Convert PHP tags to entities
     *
     * @param	string
     * @return	string
     */
    public static function encode_php_tags($str)
    {
        return str_replace(array('<?', '?>'), array('&lt;?', '?&gt;'), $str);
    }
}
