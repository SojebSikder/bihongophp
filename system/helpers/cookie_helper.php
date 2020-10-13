<?php
/**
 * Cookie Helper
 */
if ( ! function_exists('set_cookie'))
{
	/**
	 * Set cookie
	 *
	 * Accepts seven parameters, or you can submit an associative
	 * array in the first parameter containing all the values.
	 */
	function set_cookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = NULL, $httponly = NULL)
	{
        setcookie($name, $value, $expire, $path, $domain, $secure);		
	}
}


if ( ! function_exists('get_cookie'))
{
	/**
	 * Fetch an item from the COOKIE array
	 */
	function get_cookie($index, $xss_clean = NULL)
	{
		if(isset($_COOKIE[$index])){
            return $_COOKIE[$index];
        }
	}
}


if ( ! function_exists('delete_cookie'))
{
	/**
	 * Delete a COOKIE
	 */
	function delete_cookie($name, $domain = '', $path = '/', $prefix = '')
	{
		set_cookie($name, '', '', $domain, $path, $prefix);
	}
}

?>