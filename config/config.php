<?php
/**DO NOT DELETE ANYTHING HERE */
/**
 * Setup only there have (Changeable) placeholder
 */
/**
 * Config
 * PHP VERSION: 7.4.1
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
	 * Access this value on project using ROOT constant
	 */
	"baseUrl" => "http://localhost/bihongophp/", //(Changable)
	/**
	 * asset url for use assets(js/css etc.)
	 * Access this value on project using ASSET constant
	 * If you want to change your asset/resource directory then you can
	 */
	"asset" => "app/views/" 					//(Changable)
];
 

/**
 * Web Information
 */
$config['web'] = [
	"info" => [
		"web_icon" => "youricon.png", 		   //web icon (Changable)
		"web_title" => "Bihongo", 			   //web title (Changable)
		"web_slogan" => "Let's create awesome" //web slogan  (Changable)
	]
];
/**
 * User Information
 */
$config['user'] = [
	"user" => [
		"user_name" => "", 						//author name (Changable)
		"user_email" => "" 						//author email (Changable)
	]
];

/**
 * Database Connections
 */
$config['db'] = [
	"mysqli" => [
		"host" => "localhost", 					//DB Host (Changeable)
		"username" => "root", 					//DB user (Changeable)
		"password" => "", 						//DB Password (Changeable)
		"dbname" => "test", 						//DB name (Changeable)
		'dbdriver' => 'mysqli' 					//DB Driver (Changeable)
	]
 ];
/**
 * Set Database connection which to use
 */
$active_db = 'mysqli'; 							//select database (Changeable)
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
$config['mode'] = 'development'; 				//select mode (Changeable)
/**
 * Application folder
 */
$system_path = "system";
$application_folder = "app";
$view_folder = "";

/**
 * Default Character charset
 */
$config['charset'] = 'UTF-8';

/**
 * CSRF Protection
 * If csrf_protection False then csrf protection will be off.
 * Also you can change csrf token name as your requirements.
*/
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_token_name'; //(Changeable)

/**
 * Migration Directory Root
 */
$config['migration_path'] = $application_folder.'\/migrations/';

/**
 * Important constants DO NOT TOUCH THIS
 */
defined("DB_HOST")
	or define("DB_HOST", $config['db']['mysqli']['host']);
defined("DB_USER")
	or define("DB_USER", $config['db']['mysqli']['username']);
defined("DB_PASS")
	or define("DB_PASS", $config['db']['mysqli']['password']);
defined("DB_NAME")
	or define("DB_NAME", $config['db']['mysqli']['dbname']);
/**
 * Web Info
 */
defined("TITLE") //Getting Web Title
	or define("TITLE", $config['web']['info']['web_title']);
defined("SLOGAN") //Getting Web Slogan
	or define("SLOGAN", $config['web']['info']['web_slogan']);
defined("ROOT") //Getting base url
	or define("ROOT", $config['url']['baseUrl']);
defined("ASSET") //Get assets url ex. js/css etc.
	or define("ASSET", $config['url']['asset']);
defined("ICON") //Get Icon
	or define("ICON", $config['web']['info']['web_icon']);
defined("CHARSET") //Get Charset
	or define("CHARSET", $config['charset']);

/**
 * User can define constant here
 */

?>