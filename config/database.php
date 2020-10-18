<?php
/**
 * Database setup
 */

/**
 * Set Database connection which to use
 */
$active_db = 'mysql';

/**
 * Database Connections
 * 
 * You have to check out properly your perticular db driver 
 * installed on your device
 */
$config['db'] = [

	"mysql" => [
		"host" => "localhost",
		"username" => "root",
		"password" => "",
		"dbname" => "test",
		'dbdriver' => 'mysqli'
	],

	"sqlite" => [
		"url" => $application_folder."/database/test.db",
		'dbdriver' => 'sqlite'
	],

	"pgsql" => [
		"host" => "localhost",
		"port" => 5432,
		"username" => "postgres",
		"password" => "pass123",
		"dbname" => "testdb",
		'dbdriver' => 'pgsql'
	]

 ];

/**
 * Migration Table. This use to track migrations
*/
$config['migrations'] = 'migration';

/**
 * Migration Directory Root
 */
$config['migration_path'] = $application_folder.'/database/migrations/';

/**
 * Seeder Directory ROOT
 */
$config['seed_path'] = $application_folder.'/database/seeds/';


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
 * User can define constant here
 */