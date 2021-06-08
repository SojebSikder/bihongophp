<?php

/**
 * Array Helper
 */
class ArrayHelper
{
	/**
	 * Random Element - Takes an array as input and returns a random element
	 */
	public static function randomElement($array)
	{
		return is_array($array) ? $array[array_rand($array)] : $array;
	}

	/**
	 * Convert array to string
	 */
	public static function arrayToString($array, $separator = ',')
	{
		$result = '';
		foreach ($array as $key) {
			$result .= $key . ",";
		}
		return $result = rtrim($result, $separator);
	}

	/**
	 * Convert array to json
	 */
	public static function json($data)
	{

		return json_encode($data);
	}
}
