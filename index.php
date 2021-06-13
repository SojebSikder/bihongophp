<?php

use System\Core\DotEnv;

$base = "";
/**
 * DO NOT Touch Here
 */

/**
 * Autoload Core
 */
//Composer Autoload
require $base . __DIR__.'/vendor/autoload.php';
//Initialize DotEnv
//DotEnv::init();
(new DotEnv($base . '.env'))->load();

/**
 * Load Config
 */
require $base . "config/config.php";

/**
 * Exceptions
 */
/*
 *error reporting
 */
define('ENVIRONMENT', $config['mode']);

switch (ENVIRONMENT) {
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);

		ini_set("error_reporting", "true");
		error_reporting(E_ALL | E_STRICT);
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>=')) {
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		} else {
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
		break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

/**
 * Load Bootstrap file
 */
require $base . $system_path . "/core/Bihongo.php";
