<?php
/**
 * File Helper
 */

if ( ! function_exists('readFile'))
{
	/**
	 * Read File
	 *
	 * Opens the file specified in the path and returns it as a string.
	 */
	function readFile($file)
	{
		return @file_get_contents($file);
	}
}



if ( ! function_exists('writeFile'))
{
	/**
	 * Write File
	 *
	 * Writes data to the file specified in the path.
	 * Creates a new file if non-existent.
	 */
	function writeFile($path, $data, $mode = 'wb')
	{
		if ( ! $fp = @fopen($path, $mode))
		{
			return FALSE;
		}

		flock($fp, LOCK_EX);

		for ($result = $written = 0, $length = strlen($data); $written < $length; $written += $result)
		{
			if (($result = fwrite($fp, substr($data, $written))) === FALSE)
			{
				break;
			}
		}

		flock($fp, LOCK_UN);
		fclose($fp);

		return is_int($result);
	}
}



if ( ! function_exists('deleteFiles'))
{
	/**
	 * Delete Files
	 *
	 * Deletes all files contained in the supplied directory path.
	 * Files must be writable or owned by the system in order to be deleted.
	 * If the second parameter is set to TRUE, any directories contained
	 * within the supplied base directory will be nuked as well.
	 */
	function deleteFiles($path, $del_dir = FALSE, $htdocs = FALSE, $_level = 0)
	{
		// Trim the trailing slash
		$path = rtrim($path, '/\\');

		if ( ! $current_dir = @opendir($path))
		{
			return FALSE;
		}

		while (FALSE !== ($filename = @readdir($current_dir)))
		{
			if ($filename !== '.' && $filename !== '..')
			{
				$filepath = $path.DIRECTORY_SEPARATOR.$filename;

				if (is_dir($filepath) && $filename[0] !== '.' && ! is_link($filepath))
				{
					delete_files($filepath, $del_dir, $htdocs, $_level + 1);
				}
				elseif ($htdocs !== TRUE OR ! preg_match('/^(\.htaccess|index\.(html|htm|php)|web\.config)$/i', $filename))
				{
					@unlink($filepath);
				}
			}
		}

		closedir($current_dir);

		return ($del_dir === TRUE && $_level > 0)
			? @rmdir($path)
			: TRUE;
	}
}



?>