<?php
/**
 * Path Helper
 */
if ( ! function_exists('set_realpath'))
{
	/**
	 * Set Realpath
	 */
	function set_realpath($path, $check_existance = FALSE)
	{
		// Security check to make sure the path is NOT a URL. No remote file inclusion!
		if (preg_match('#^(http:\/\/|https:\/\/|www\.|ftp|php:\/\/)#i', $path) OR filter_var($path, FILTER_VALIDATE_IP) === $path)
		{
			show_error('The path you submitted must be a local server path, not a URL');
		}

		// Resolve the path
		if (realpath($path) !== FALSE)
		{
			$path = realpath($path);
		}
		elseif ($check_existance && ! is_dir($path) && ! is_file($path))
		{
			show_error('Not a valid path: '.$path);
		}

		// Add a trailing slash, if this is a directory
		return is_dir($path) ? rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR : $path;
	}
}
?>