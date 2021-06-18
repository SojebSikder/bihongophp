<?php

/**DO NOT DELETE ANYTHING HERE */
/**
 * Config
 * Since PHP VERSION: 7.4.1
 */

/**
 * Application Name
 * This value is the name of your application. This value is used when the
 * framework needs to place the application's name in a notification or
 * any other location as required by the application or its packages.
 */
$config['name'] = env('APP_NAME', 'Bihongo');

/**
 * URL to your project root. This will your base URL, with a trailing slash:
 *  http://example.com
 * 
 * WARNING: You MUST set baseUrl value
 */
$config['url'] = [
	/**
	 * base url of application
	 */
	"baseUrl" => env("SERVER_URL", "http://localhost"),

	/**
	 * asset directory for use assets(js/css etc.)
	 * Access this value on project using ASSET constant
	 * If you want to change your asset/resource directory then you can
	 */
	"asset" => "public/",
	/**
	 * resource directory
	 */
	"resource" => "resources/",
];


/**
 * Set mode
 * For develpment : 'development'
 * For production : 'production'
 * 
 * In development mode all errors will be shown on user side
 * In Production mode errors will be not shown on user side
 * 
 * 
 */
$config['mode'] = env('APP_ENV', 'production');
/**
 * Application folder
 */
$system_path = "system";
$application_folder = "app";
$view_folder_path = "resources/views";

/**
 * Default Character charset
 */
$config['charset'] = 'UTF-8';

/**
 * Default locale
 */
$config['locale'] = 'en';

/**
 * Default timezone
 */
$config['timezone'] = 'Asia/Dhaka';

/**
 * CSRF Protection
 * If csrf_protection False then csrf protection will be off.
 * Also you can change csrf token name as your requirements.
 */
$config['csrf_protection'] = false;
$config['csrf_token_name'] = 'csrf_token_name';

/**
 * Cache path
 */
$config['cache_path'] = 'storage/cache/';
/**
 * Session path
 */
$config['session_path'] = 'storage/sessions';

/**
 * TE Templating Engine
 * Template syntax for
 * {{ expressions }}
 */
$config['left_deli'] = "{{";
$config['right_deli'] = "}}";

/**
 * Importnt Constant || DO not Edit here
 */
// Getting web name
defined("name")
	or define("name", $config['name']);
//Getting base url
defined("ROOT")
	or define("ROOT", $config['url']['baseUrl']);
//Get assets directory
defined("ASSET")
	or define("ASSET", $config['url']['baseUrl'] . "/" . $config['url']['asset']);
//Get resources directory
defined("RESOURCE")
	or define("RESOURCE", $config['url']['baseUrl'] . "/" . $config['url']['resource']);
//Getting base element
defined("BASE")
	or define("BASE", '<base href="' . ROOT . '">');
//Get Charset
defined("CHARSET")
	or define("CHARSET", $config['charset']);
//Get Charset
defined("cache_path")
	or define("cache_path", $config['cache_path']);
/**
 * User can define constant here
 */
