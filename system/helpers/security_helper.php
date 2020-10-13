<?php
/**
 * Security Helper
 */
if(!function_exists('Stext')){

    function Stext($string, $allow = null){
        if($allow == null){
            $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $text = $conn->real_escape_string(htmlspecialchars(strip_tags($string)));
        }else{
            $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $text = $conn->real_escape_string(strip_tags($string, $allow));
        }
        return $text;
    }
}

if ( ! function_exists('encode_php_tags'))
{
	/**
	 * Convert PHP tags to entities
	 *
	 * @param	string
	 * @return	string
	 */
	function encode_php_tags($str)
	{
		return str_replace(array('<?', '?>'), array('&lt;?', '?&gt;'), $str);
	}
}

?>