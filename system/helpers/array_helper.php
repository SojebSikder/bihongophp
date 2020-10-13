<?php
/**
 * Array Helper
 */

if ( ! function_exists('randomElement'))
{
	/**
	 * Random Element - Takes an array as input and returns a random element
	 */
	function randomElement($array)
	{
		return is_array($array) ? $array[array_rand($array)] : $array;
	}
}
?>