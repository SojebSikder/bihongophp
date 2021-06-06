<?php
/**DO NOT DELETE ANYTHING HERE */
/**
 * Config
 * Since PHP VERSION: 7.4.1
 */

/**
 * URL to your project root. This will your base URL, with a trailing slash:
 *  http://example.com
 * 
 * WARNING: You MUST set baseUrl value
 */
$config['url'] = [
	/**
	 * base url (Changeable) like: http://localhost/bihongophp/
	 * OR
	 * just -> / (slash)
	 * Access this value on project using ROOT constant
	 */
	"baseUrl" => "/bihongophp/",	
	
	/**
	 * asset url for use assets(js/css etc.)
	 * Access this value on project using ASSET constant
	 * If you want to change your asset/resource directory then you can
	 */
	"asset" => "public/"
];


/**
 * Web Information
 */
$config['web'] = [
	"info" => [
		"web_icon" => "youricon.png", 		   
		"web_title" => "Bihongo", 			   
		"web_slogan" => "Let's create awesome"
	]
];
/**
 * User Information
 */
$config['user'] = [
	"user" => [
		"user_name" => "",
		"user_email" => ""
	]
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
$config['mode'] = 'development';
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
defined("TITLE") //Getting Web Title
	or define("TITLE", $config['web']['info']['web_title']);
defined("SLOGAN") //Getting Web Slogan
	or define("SLOGAN", $config['web']['info']['web_slogan']);
defined("ROOT") //Getting base url
	or define("ROOT", $config['url']['baseUrl']);
defined("ASSET") //Get assets url ex. js/css etc.
	or define("ASSET", $config['url']['baseUrl'].$config['url']['asset']);
defined("BASE") //Getting base element
	or define("BASE", '<base href="'.ROOT.'">');
defined("ICON") //Get Icon
	or define("ICON", $config['web']['info']['web_icon']);
defined("CHARSET") //Get Charset
	or define("CHARSET", $config['charset']);
defined("cache_path") //Get Charset
	or define("cache_path", $config['cache_path']);
/**
 * User can define constant here
 */

