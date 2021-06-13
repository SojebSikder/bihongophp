<?php

namespace System\Helpers;

/**
 * Cookie Helper
 */
class Cookie
{
	/**
	 * Set cookie
	 *
	 * Accepts seven parameters, or you can submit an associative
	 * array in the first parameter containing all the values.
	 */
	public static function setCookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = NULL, $httponly = NULL)
	{
		setcookie($name, $value, $expire, $path, $domain, $secure);
	}


	/**
	 * Fetch an item from the COOKIE array
	 */
	public static function getCookie($index, $xss_clean = NULL)
	{
		if (isset($_COOKIE[$index])) {
			return $_COOKIE[$index];
		}
	}

	/**
	 * Delete a COOKIE
	 */
	public static function deleteCookie($name, $domain = '', $path = '/', $prefix = '')
	{
		setcookie($name, '', '', $domain, $path, $prefix);
	}
}
