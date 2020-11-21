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

 }
