<?php
/**
 * Cookie Helper
 */
if ( ! function_exists('setCookie'))
{
	/**
	 * Set cookie
	 *
	 * Accepts seven parameters, or you can submit an associative
	 * array in the first parameter containing all the values.
	 */
	function setCookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = NULL, $httponly = NULL)
	{
        setcookie($name, $value, $expire, $path, $domain, $secure);		
	}
}


if ( ! function_exists('getCookie'))
{
	/**
	 * Fetch an item from the COOKIE array
	 */
	function getCookie($index, $xss_clean = NULL)
	{
		if(isset($_COOKIE[$index])){
            return $_COOKIE[$index];
        }
	}
}


if ( ! function_exists('deleteCookie'))
{
	/**
	 * Delete a COOKIE
	 */
	function deleteCookie($name, $domain = '', $path = '/', $prefix = '')
	{
		set_cookie($name, '', '', $domain, $path, $prefix);
	}
}

?>