<?php
/**DO NOT DELETE ANYTHING HERE */
/**
 * Setup only there have (Changeable) placeholder
 */
/**
 * Config
 */
$config = array(

	//web information
	"web" => array(
		"info" => array(
			"web_icon" => "youricon.png", 		   //web icon (Changable)
			"web_title" => "Bihongo", 			   //web title (Changable)
			"web_slogan" => "Let's create awesome" //web slogan  (Changable)
		),
		//user information
		"user" => array(
			"user_name" => "", //author name (Changable)
			"user_email" => "" //author email (Changable)
		)
	),

	//For Database
	"db" => array(
		"mysql" => array(
			"host" => "localhost", //DB Host (Changeable)
			"username" => "root", //DB user (Changeable)
			"password" => "", //DB Password (Changeable)
			"dbname" => "", //DB name (Changeable)
			'dbdriver' => 'mysql', //DB Driver (Changeable)
		)
	),

	//For urls
	"url" => array(
		"baseUrl" => "http://localhost/bihongophp/", //base url (Changeable) like: http://localhost/bihongophp/
		"asset" => "app/views/"
	),

);
/**
 * Set Database connection which to use
 */
$active_db = 'mysql'; //select database (Changable)
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
$config['mode'] = 'development'; //select mode (Changable)
/**
 * Application folder
 */
 $system_path = "system";
 $application_folder = "app";
 $view_folder = "";
/**
 * Important constants DO NOT TOUCH THIS
 */
defined("DB_HOST")
	or define("DB_HOST", $config['db']['mysql']['host']);
defined("DB_USER")
	or define("DB_USER", $config['db']['mysql']['username']);
defined("DB_PASS")
	or define("DB_PASS", $config['db']['mysql']['password']);
defined("DB_NAME")
	or define("DB_NAME", $config['db']['mysql']['dbname']);
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
/**
 * Bihongo PHP Version
 */
define("B_VERSION", "1.0")
?>